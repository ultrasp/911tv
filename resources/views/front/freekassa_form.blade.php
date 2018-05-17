<form method='get' action='{{config('payment.freekassa.url')}}' class="hidden">
	<input type='hidden' name='m' value='{{config('payment.freekassa.merchant_id')}}'>
    <input type='hidden' name='oa' class="total_amount" value='{{$cart->amount}}'>
    <input type='hidden' name='o' value='{{$cart->id}}'>
    <input type='hidden' name='s' class="free_sign" value='{{$cart->getFreekassaSign()}}'>
    <input type='hidden' name='lang' value='{{config('app.locale')}}'>
    <input type='hidden' name='us_login' value='{{Auth::user()->username}}'>
</form>
