<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Details</div>

                    <div class="card-body">
						<a :href="cart_url">Back to Cart</a>
					
                        <p>Items: $11.97</p>
						<p>Shipping & Handling: $2.00</p>
						<p>Promo discounts: $0.00</p>
						
						<p>Total before tax: $13.97</p>
						<p>Estimated tax to be collected: $2.50</p>
						
						<p>Order total: $16.47</p>
						
						<a :href="thankyou_url">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props : ['cart_url', 'thankyou_url'],
	}
</script>