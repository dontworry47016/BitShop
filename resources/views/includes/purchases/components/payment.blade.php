<div class="col-md-12">
    <h3 class="mb-4">Payment</h3>

    <table class="table ">
        <tr>
            <td>To pay:</td>
            <td>
                @if($purchase -> isDelivered())
                    {{ $purchase -> coin_sum }} <span class="badge badge-primary">Paid</span>
                @elseif($purchase -> isCanceled())
                    <span class="badge badge-danger">Canceled</span>
                @elseif($purchase -> isDisputed() && $purchase -> dispute -> isResolved())
                    <span class="badge badge-primary">Resolved</span>
                @else
                    {{ $purchase -> coin_sum }} <span class="badge badge-info">{{ $purchase -> coin_label }}</span>
                @endif
            </td>
        </tr>
        <tr>
            <td>Address received:</td>
            <td>
                @if($purchase -> isDelivered())
                    @if($purchase -> coin_balance == 'unavailable')
                        <span class="badge badge-danger">{{ $purchase -> coin_balance }}</span>
                    @else
                        {{ $purchase -> coin_balance }} <span class="badge badge-info">{{ $purchase -> coin_label }}</span>
                    @endif
                @elseif($purchase -> isCanceled())
                    <span class="badge badge-danger">Canceled</span>
                @elseif($purchase -> isDisputed() && $purchase -> dispute -> isResolved())
                    <span class="badge badge-primary">Resolved</span>
                @else
                    @if($purchase -> coin_balance == 'unavailable')
                        <span class="badge badge-danger">{{ $purchase -> coin_balance }}</span>
                    @else
                        {{ $purchase -> coin_balance }} <span class="badge badge-info">{{ $purchase -> coin_label }}</span>
                    @endif
                    @if($purchase -> enoughBalance()) <span class="badge badge-primary">Paid</span> @endif
                @endif
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td><input type="text" readonly class="form-control" value="{{ $purchase -> address }}"></td>
        </tr>
        <tr>
            <td>State</td>
            <td>
                <div class="btn-group">
                    <span class="btn btn-sm @if($purchase -> isPurchased()) btn-primary @else btn-outline-secondary @endif">Purchased</span>
                    <span class="btn btn-sm @if($purchase -> isSent()) btn-primary @else btn-outline-secondary @endif">Sent</span>
                    <span class="btn btn-sm @if($purchase -> isDelivered()) btn-primary @else btn-outline-secondary @endif">Delivered</span>
                    <span class="btn btn-sm @if($purchase -> isDisputed()) btn-red @else btn-outline-secondary @endif">Disputed</span>
                    <span class="btn btn-sm @if($purchase -> isCanceled()) btn-red @else btn-outline-secondary @endif">Canceled</span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="justify-content-center text-center">
                @if($purchase->isPurchased())
                    <a href="{{ route('profile.purchases.canceled.confirm', $purchase) }}"
                       class="btn btn-red"><i class="fas fa-window-close mr-1"></i> Cancel</a>
                @endif


                @if($purchase -> isPurchased() && $purchase -> isVendor())
                    <a href="{{ route('profile.sales.sent.confirm', $purchase) }}"
                       class="btn btn-primary"><i class="fas fa-clipboard-check mr-2"></i> Ship
                    </a>
                @endif

                @if($purchase->type == 'normal'  && $purchase -> isSent() && $purchase -> isBuyer())
                    <a href="{{ route('profile.purchases.delivered.confirm', $purchase) }}"
                       class="btn btn-primary"><i class="fas fa-clipboard-check mr-2"></i> Recieved
                    </a>
                @endif

                {{-- Show to vendor if it is delivered --}}
                @if($purchase->hex && $purchase->isDelivered() && $purchase->isVendor())
                    <div class="alert alert-warning">
                        To retrieve funds from this purchase please sign this transaction and send it.
                    </div>
                    <textarea cols="30" rows="5" class="form-control" readonly>{{ $purchase->hex }}</textarea>
                @endif
                {{-- Show to the winner if it is resolved --}}
                @if($purchase->hex && $purchase->isDisputed() && $purchase->dispute->isResolved() && $purchase->dispute->isWinner())
                    <div class="alert alert-warning">
                        To retrieve funds from this purchase please sign this transaction and send it.
                    </div>
                    <textarea cols="30" rows="5" class="form-control" readonly>{{ $purchase->hex }}</textarea>
                @endif
            </td>




        </tr>

    </table>

    {{-- Instructions for escrow --}}
    {{-- Purchased buyer--}}
    @if($purchase -> isPurchased() && $purchase -> isBuyer() && !$purchase -> enoughBalance())
        <div class="alert alert-primary text-center">
            To proceed with purchase send enough {{ $purchase -> coin_label }} to the address: <span class="badge badge-info">{{ $purchase -> address }}</span>
        </div>
    @endif

    {{-- Purchased vendor --}}
    @if($purchase -> isVendor() && $purchase -> isPurchased() && $purchase -> enoughBalance())
        <div class="alert alert-primary text-center">
            This order is paid. Please mark shipped after shipping.
        </div>
    @elseif($purchase -> isVendor() && $purchase -> isPurchased())
        <div class="alert alert-warning text-center">
            This order is unpaid.
        </div>
    @endif

    {{-- Sent vendor --}}
    @if($purchase -> isBuyer() && $purchase -> isSent())
        <div class="alert alert-warning text-center">
            By marking this purchase as delivered you will release the funds to the vendor.
        </div>
    @endif


</div>
