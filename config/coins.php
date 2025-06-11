<?php

return [

    /**
     * List of coins supported by this market
     * Mapped in the implementations
     *
     */
    'coin_list' => [
        'btc' => \App\Marketplace\Payment\BitcoinPayment::class,
//       'btcm' => \App\Marketplace\Payment\BitcoinMutlisig::class, // bitcoin multisig
        'xmr' => \App\Marketplace\Payment\MoneroPayment::class,
//        'stb' => \App\Marketplace\Payment\StubCoin::class,
//        'pivx' => \App\Marketplace\Payment\PivxCoin::class,
//        'ltc' => \App\Marketplace\Payment\LitecoinPayment::class,
//        'dash' => \App\Marketplace\Payment\DashPayment::class,
//        'bch' => \App\Marketplace\Payment\BitcoinCashPayment::class,
//        'xvg' => \App\Marketplace\Payment\VergeCoin::class,
    ],

    /**
     * RPCWrapper settings
     *
     * Uses data from .env file
     */
    'bitcoin' => [
        'host' => env('BITCOIND_HOST', 'localhost'),
        'username' => env('BITCOIND_USERNAME', ''),
        'password' => env('BITCOIND_PASSWORD', ''),
        'port' => env('BITCOIND_PORT', 8332),
        'minconfirmations' => env('BITCOIND_MINCONFIRMATIONS', 1),
    ],


    /**
     * Monero settings
     *
     * Uses data from .env file
     */

    'monero' => [
        'host' => env('MONERO_HOST','127.0.0.1'),
        'port' => intval(env('MONERO_PORT',28088)),
        'username' => env('MONERO_USERNAME',''),
        'password' => env('MONERO_PASSWORD','')


    ],

    /**
     * PIVX settings
     */
    'pivx' => [
        'host' => env('PIVX_HOST','127.0.0.1'),
        'port' => intval(env('PIVX_PORT',51475)),
        'username' => env('PIVX_USERNAME','username'),
        'password' => env('PIVX_PASSWORD','password')
    ],

    /**
     * Litecoin settings
     */
    'litecoin' => [
        'host' => env('LITECOIN_HOST','127.0.0.1'),
        'port' => intval(env('LITECOIN_PORT',19332)),
        'username' => env('LITECOIN_USERNAME','myuser'),
        'password' => env('LITECOIN_PASSWORD','mypassword')
    ],

    /**
     * DASH settings
     */
    'dash' => [
        'host' => env('DASH_HOST','127.0.0.1'),
        'port' => intval(env('DASH_PORT',19998)),
        'username' => env('DASH_USERNAME','myuser'),
        'password' => env('DASH_PASSWORD','mypassword')
    ],

    /**
     * Bitcoin Cash settings
     */
    'bictoin_cash' => [
        'host' => env('BITCOIN_CASH_HOST','127.0.0.1'),
        'port' => intval(env('BITCOIN_CASH_PORT',18332)),
        'username' => env('BITCOIN_CASH_USERNAME','myuser'),
        'password' => env('BITCOIN_CASH_PASSWORD','mypassword')
    ],

    /**
     * VergeCurrency settings
     */
    'xvg' => [
        'host' => env('VERGE_HOST','127.0.0.1'),
        'port' => intval(env('VERGE_PORT',21102)),
        'username' => env('VERGE_USERNAME','myuser'),
        'password' => env('VERGE_PASSWORD','mypassword')
    ],


    /**
     * Refreshing cache for RPCWrapper price loading
     */
    'caching_price_interval' => 20,

    /**
     * Leave empty array if you want to keep the funds on the purchase addresses
     *
     * Market addresses, funds from fee will be sent to one random address from this array
     */
    'market_addresses' => [
        'btc' => [ // list of btc addresses
            ''
        ],
        'ltc' => [ // list of btc addresses
            ''
        ],
        'pivx' => [ // list of pivx addresses
            ''
        ],
        'dash' => [
            ''
        ],
        'xmr' => [
            ''
        ],
        'stb' => [
            '',
            ''
        ]
    ],
    'multisig' => [
        'balance_api' => 'https://testnet.blockchain.info/balance?active=',
        'unspent_api' => 'https://testnet.blockchain.info/unspent?active=',
    ],
];
