<div>
    @if($purchase -> coin_label == "XMR")
    @php
    $text = "monero:{$purchase->address}?tx_amount={$purchase->coin_sum}"
    @endphp
    {!! QrCode::size(250)->generate("$text") !!}
    @endif
    @if($purchase -> coin_label == "BTC")
    @php
    $text = "bitcoin:{$purchase->address}?amount={$purchase->coin_sum}"
    @endphp
    {!! QrCode::size(250)->generate("$text") !!}
    @endif
</div>
