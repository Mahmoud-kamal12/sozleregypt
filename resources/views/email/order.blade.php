<h1>Order {{$order->paymob_order_status ? 'success' : 'failed'}}</h1>

your order number is: {{$order->id}} <br>

your order PayMob number is : {{$order->paymob_order_id}} <br>

your transaction PayMob number is : {{$order->paymob_transaction_id}} <br>

your order status is : {{$order->paymob_order_status ? 'success' : 'failed'}} <br>

