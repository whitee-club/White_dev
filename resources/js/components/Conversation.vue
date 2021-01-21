<template>
<div class="conversation">
	<h1>{{contact ? contact.name : 'Select a Contact'}} <button id="back" v-on:click="back()" > <img src="/svg/back.svg"></button> </h1>
	<MessageFeed :contact="contact" :messages="messages"/>
	<MessageComposer @send="check"/>
	



</div>
</template>

<script>
	import MessageFeed from './MessageFeed.vue';
	import MessageComposer from './MessageComposer.vue';

	export default {
		props: {
			contact: {
			type: Object,
			default: null
},
		messages: {
			type: Array,
			default: []
}
},
	methods: {
		check(text){
			if(this.contact.list_no == "2"){
			return	this.sendMessageNew(text);
			}
			this.sendMessage(text);
		},
		sendMessage(text){
			if (!this.contact) {
			return;
}
		axios.post('/conversation/send', {
		contact_id: this.contact.friends_id,
		text: text
	}).then((response) => {
		this.$emit('new', response.data);
}) 
},
sendMessageNew(text)
{
	if (!this.contact) {
			return;
}
		axios.post('/conversationNew/send', {
		contact_id: this.contact.friends_id,
		text: text
	}).then((response) => {
		this.$emit('new', response.data);
}) 
},
back()
{
	this.$emit('back');
}

},
	
components: {MessageFeed, MessageComposer}

}

</script>


<style lang="scss" scoped>
.conversation {
    flex: 5;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h1 {
        font-size: 20px;
        padding: 10px;
        margin: 0;
        background: white;

    #back{
    	float:right;
    }
    button {
    	border: none;
    	background-color: white;
    }
    img {
    	width: 30px;
    }
    }
}
</style>