@if (session()->has('message'))
    <div class="message_alert hidden" data-type='{{session()->pull('message_type', 'success')}}'>
    	{{session('message')}}
    </div>
@endif
