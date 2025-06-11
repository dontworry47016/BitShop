@if(config('marketplace.js_warning'))
    <div class="mt-3">
        <div id="jswarning"></div>
    </div>
    <script>
        let warningText = 'If you see this, javascript is on. We recommend turning it off.'
        let jsWarning = document.getElementById('jswarning');
        let alert = document.createElement('div');
        let span = document.createElement('span');
        alert.classList.add('alert');
        alert.classList.add('alert-danger');
        alert.classList.add('text-center');
        span.innerText = warningText;
        alert.appendChild(span);
        jsWarning.appendChild(alert);
    </script>
@endif
