<template>
    <div class="chat-app">
        <h4 :class="{buttonStyle2:button2.status}">Contacts</h4>
    
    <div id="toggle" :class="{buttonStyle2:button2.status}">
    <button id="received" v-on:click="displayList1()" :class="{buttonStyle1:button1.status}">Received</button><span :class="{buttonStyle2:button2.status}">|</span>
    <button id="sent" v-on:click="displayList2()" :class="{buttonStyle2:button2.status}">Sent</button>
    </div>
        <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage" @back="backf" v-bind:class="{conversationStyle:conversation.status}" />
        <ContactsList :contacts="contacts" @selected="startConversationWith" :class="{contactsListStyle1:contactsList1.status}"/>
       
        <NewContact :newcontacts="newcontacts" @selectedd="startConversationWithNew" v-bind:class="{contactsListStyle2:contactsList2.status}"/>
        
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactsList from './ContactsList';
    import NewContact from './NewContact';

    export default {
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                newcontacts:[],
                conversation: {
                   status: true,
                },
                contactsList1: {
                    status: false,
                },
                contactsList2: {

                status:  true,
            },
                button1: {
                    status: false,
                },
                button2: {
                    status: false,
                }, 
                back: {
                    status: true,
                },            

            };
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });
                Echo.private(`messages.${this.user.uuid}`)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });

            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });

            axios.get('/newcontacts')
                .then((response) => {
                    this.newcontacts = response.data;
                });
        },
        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/conversation/${contact.friends_id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    });
                    this.conversation.status = false;
                    this.contactsList1.status = true;
                    this.contactsList2.status = true;
                    this.button1.status = true;
                    this.button2.status = true;
                    this.back.status = false;

            },
            startConversationWithNew(contact) {
                this.updateUnreadCountNew(contact, true);

                axios.get(`/conversationNew/${contact.friends_id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    });
                    this.conversation.status = false;
                    this.contactsList1.status = true;
                    this.contactsList2.status = true;
                    this.button1.status = true;
                    this.button2.status = true;
                    this.back.status = false;

            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.friends_id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false);
            },
            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map((single) => {
                    if (single.friends_id !== contact.friends_id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            },

            updateUnreadCountNew(contact, reset) {
                this.newcontacts = this.newcontacts.map((single) => {
                    if (single.friends_id !== contact.friends_id) {
                        return single;
                    }

                    if (reset)
                        single.unread = 0;
                    else
                        single.unread += 1;

                    return single;
                })
            },
        displayList1()
        {
            this.contactsList1.status = false;
            this.contactsList2.status = true;

        },
        displayList2(){
            this.contactsList1.status = true;
            this.contactsList2.status = false;
            this.conversation.status = true;
        },
        backf()
        {
            this.contactsList1.status = false;
            this.conversation.status = true;
            this.button1.status = false;
            this.button2.status = false;
            this.back.status = true;
        }
        },
        components: {Conversation, ContactsList, NewContact}
    }
</script>


<style lang="scss" scoped>
.chat-app {
    /*display: flex;*/
    background: #f5f6fa;
    overflow: auto;
    overflow-x: hidden;
}
.contactsListStyle1 {
    /*background-color: black;*/
    display: none;
}
.contactsListStyle2 {
    display:none;
}
.conversationStyle {
    display: none;
}
.buttonStyle1 {
    display: none;

}
#received {
    border: none;
    margin-right: 10px;
    padding-left: 0px;
    padding-right: 0px;
    background: #f5f6fa;



}
#sent {
    border: none;
    margin-left: 10px;
    /*padding-left: 0px;
    padding-right: 0px;*/
    background: #f5f6fa;


}

#received:hover, #received:active, #received:focus {
    padding: 0px 10px;
    color: white;
    background: black;
    border-radius: 8px;
}

#sent:hover, #sent:active, #sent:focus {
    padding: 0px 10px;
    color: white;
    background: black;
    border-radius: 8px;
}

span {
    font-size: 25px;
}
.buttonStyle2 {
    display: none;
}
.backStyle {
    display: none;
}
h4 {
    text-align: center;
    /*display: inline-block;*/
    width: fit-content;
    margin: auto;
    border-radius: 20px;
    padding: 3px 12px 3px 12px;
    letter-spacing: 2px;
    /*font-weight: 800;*/
    background-color: #3490dc;
    color: white;  
    border:solid;
    margin-top: 20px;
}
#toggle {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    margin: 10px 0 ;
    width: 50%;
    /*margin-bottom: 100px;*/
    margin: auto;
    margin-bottom: 20px;
    /*margin-top: 5px; */
}


</style>