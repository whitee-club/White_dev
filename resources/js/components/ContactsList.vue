<template>
    <div class="contacts-list">
        <div class="cf" v-if="contacts == 0">
      <h3>No Contacts Found</h3>
      <h4>Share <img src="/svg/cl.svg" alt="Confession link"> with friends to get confessions, and have an anonymous conversation with them.</h4>
        </div>
        <ul v-else>
            <li v-for="contact in sortedContacts" :key="contact.friends_id" @click="selectContact(contact)" :class="{ 'selected': contact == selected }">
                
                <div class="contact">
                    <h4 class="name">{{ contact.name }}</h4> 
                </div>
                <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
            </li>
        </ul>
    </div>
</template>


<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;

                this.$emit('selected', contact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.contacts, [(contact) => {
                    if (contact == this.selected) {
                        return Infinity;
                    }

                    return contact.unread;
                }]).reverse();
            }
        }
    }
</script>

<style lang="scss" scoped>
.contacts-list {
    flex: 2;
    max-height: 100%;
    height: 600px;
    overflow: scroll;
    background:white;
    width: 85%;
    margin: auto;
    overflow: auto;
    border-radius: 10px;

    
    ul {
        list-style-type: none;
        padding-left: 0;

        li {
            display: flex;
            padding: 2px;
            border-bottom: 0.5px solid #aaaaaa;
            height: 65px;
            position: relative;
            cursor: pointer;
            width: 85%;
            margin: auto;

            .selected {
                background: #dfdfdf;
            }

            span.unread {
                background: #304157;
                color: #fff;
                position: absolute;
                right: 11px;
                top: 20px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 3px;
            }

            
            .contact {
                flex: 3;
                font-size: 10px;
                overflow: hidden;
                display: inline;
                flex-direction: column;
                justify-content: left;
                text-align: center;
                p {
                    margin: 0;

                    .name {
                        font-weight: bold;
                        margin: auto;
                    }
                }
            }
        }
    }
}

h4{
    padding-top:25px;
}
 .cf h3,
    .cf h4 {
        text-align: center;
    }





</style>