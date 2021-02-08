<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Cart</div>

                    <div class="card-body">
                        <table>
							<tr>
								<th>Name:</th>
								<th>Price:</th>
							</tr>
							<tr>
								<td>Sweet Onion Chicken Teriyaki</td>
								<td>$7.99</td>
							</tr>
							<tr>
								<td>Chocolate Chip Cookie</td>
								<td>$0.99</td>
							</tr>
							<tr>
								<td>Diet Coke</td>
								<td>$1.99</td>
							</tr>
						</table>
						
						<a :href="url">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props : ['url'],
	}
</script>