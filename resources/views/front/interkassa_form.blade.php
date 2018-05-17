<form method='get' action='{{config('payment.interkassa.url')}}' class="hidden"  accept-charset="UTF-8">
	<input type='hidden' name='ik_co_id' value='{{config('payment.interkassa.merchant_id')}}'>
    <input type='hidden' name='ik_pm_no' value='{{$cart->id}}'>
    <input type='hidden' class="total_amount" name='ik_am' value='{{$cart->amount}}'>
    <input type='hidden' name='ik_cur' value='{{config('payment.currency')}}'>
    <input type='hidden' name='ik_loc' value='{{config('app.locale')}}'>
    <input type='hidden' name='ik_desc' value='Заказ {{$cart->id}}'>
</form>
