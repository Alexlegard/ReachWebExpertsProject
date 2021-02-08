<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thank you!</div>

                    <div class="card-body">
						<p>Your order has been placed. Please check your email for
						order confirmation and delivery information.</p>
					
						<a :href="home_url">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props : ['home_url', 'thankyou_url'],
	}
</script>