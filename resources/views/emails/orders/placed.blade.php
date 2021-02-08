<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<title>Your Order from RWE Store</title>
</head>
<body>
	<p>Thank you for your order from RWE Store.</p>
	
	<div>
		Order ID: {{ $order->id }}
	</div>
	<div>
		Order Email: {{ $order->billing_email }}
	</div>
	<div>
		Order billing name: {{ $order->billing_name }}
	</div>
	<div>
		Order total: ${{ round($order->billing_total) }}
	</div>
</body>
</html>