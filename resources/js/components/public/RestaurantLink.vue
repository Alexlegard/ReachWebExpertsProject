<template>
    <div class="RestaurantLink">
        <h5><a :href="url">{{ name }}</a></h5>
    </div>
</template>

<script>
	export default {
		props : ['name', 'url']
	}
</script>

<style>
.RestaurantLink {
	background-color:#DCDCDC;
}
</style>