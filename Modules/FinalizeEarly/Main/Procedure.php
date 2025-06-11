<?php


namespace Modules\FinalizeEarly\Main;


use App\Exceptions\RequestException;
use App\Marketplace\ModuleManager;
use App\Purchase;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use MoneroIntegrations\MoneroPhp\daemonRPC;
use MoneroIntegrations\MoneroPhp\walletRPC;

require_once('src/jsonRPCClient.php');
require_once('src/daemonRPC.php');
require_once('src/walletRPC.php');

class Procedure
{
    public function commandHandle($command){
        $command->info(Purchase::where(function($query){
            $query->where('state', 'sent');
            $query->where('type', 'fe');
        })->toSql());
        // select all in this state with finalize early
        $purchasedPurchases = Purchase::where(function($query){
            $query->where('state', 'sent');
            $query->where('type', 'fe');
        })->get();
        $command->info("There are " . $purchasedPurchases->count() . " total FE orders.");

        // foreach purchase
        foreach ($purchasedPurchases as $purchase){

            // identify purchase in console
            $command->info("Attempting to process $purchase->short_id : \n");

            // check if there is enough  balance
            if($purchase->enoughBalance()){
                try{
                    // Complete them if there are
                    $purchase->complete();
                    $command->info("This purchase is sent/queued.");
                }
                catch (RequestException $exception){
                    $purchase->status_notification  = $exception->getMessage();
                    $purchase->save();
                    $command->error("Unable to finish transaction, check the log for details.");
                    Log::error($exception);
                }
            }else{
                $command->warn("Purchase is not paid, so don't worry.");
            }
        }

        $command->info( 'There are ' . Purchase::where('state', 'purchased')->where('type', 'fe')->count() . ' FE purchases waiting for funds.');
        
        $XMRQueue = DB::table('xmrqueue')
                       ->select('amount', 'address')
                       ->where('completed', '=', false)
                       ->limit(16)
                       ->get();
        if($XMRQueue->count() != 0) {
        $command->info("attempting " . $XMRQueue->count() . " monero transactions");
        $destinations = json_decode(json_encode($XMRQueue), true);
        $walletRPC = new walletRPC('127.0.0.1', 28088);
        $walletRPC->transfer($destinations);
        $affected = DB::table('xmrqueue')
              ->update(['completed' => true]);
        $command->info("Successfully completed " . $XMRQueue->count() . " monero transactions");
        } else {
        $command->info("No queued monero transactions"); }

    }

}
