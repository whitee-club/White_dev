<template>
	<div class="composer">
	<textarea v-model="message" @keydown.enter="send" placeholder="Message..."></textarea>
	<button @click="send"><img src="/png/send.png"></button>
	</div>
</template>


<script>
	export default {
	data() {
		return {
		message: ''				
			};
	      },
		methods: {
			send(e) {
				e.preventDefault();
			    if (this.message == '') {
				return;
	}

	this.$emit('send', this.message);
	this.message = '';
}
}
}	

</script>


<style lang="scss" scoped>
.composer {
	
	display: flex;
	align-items: center;
}
.composer button {
	height: 30px;
	width: 35px;
	border: none;
	background: #f5f6fa;
	margin-right: 20px;
	
}
img {
	height: 30px;
	width: 30px;
}
.composer textarea {
    width: 95%;
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
</style>
