<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome!</div>

                    <div class="card-body">
						
						{{ restaurants }}
						
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default {
		props : [
			'restaurants'
		],
	}
</script>