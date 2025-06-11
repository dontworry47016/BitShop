@if($fb->type == 'positive')
    <span class="fas fa-thumbs-up text-success"></span>
@endif
@if($fb->type == 'neutral')
    <span class="fas fa-minus text-secondary"></span>
@endif
@if($fb->type == 'negative')
    <span class="fas fa-thumbs-down text-danger"></span>
@endif
