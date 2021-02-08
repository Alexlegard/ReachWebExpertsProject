<template>
	<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ name }} vue component</div>

                    <div class="card-body">
                        <p>Address: {{ address }}</p>
						<p>Cuisine: {{ cuisine }}</p>
						<a :href="dishesurl">Dishes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props: {
			name: String,
			address: String,
			cuisine: String,
			dishesurl: String
		}
	}
</script>

<style scoped>

</style>