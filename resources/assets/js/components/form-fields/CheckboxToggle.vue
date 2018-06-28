<template>
	<small class="checkbox-options pull-right">
		<a id="checkAll" @click="toggle">All</a>
		|
		<a id="checkNone" @click="toggle">Clear</a>
	</small>
</template>

<script>
	export default {
		props: ['criteria'],
		data() {
			return {
				toggleSwitch: null
			}
		},
		methods: {
			toggle(){
				this.toggleSwitch = !this.toggleSwitch;
				$('.' + this.criteria).prop('checked', this.toggleSwitch);
			},
		},
	};
</script>
