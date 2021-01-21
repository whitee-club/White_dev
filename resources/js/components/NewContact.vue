<template>
    <div class="contacts-list">
        <div class="cf" v-if="newcontacts == 0">
      <h3>No Contacts Found</h3>
      <h4>Get your friend's <img src="/svg/cl.svg" alt="Confession link"> Send them anonymous confession and have a conversation with them here.</h4>
        </div>
        <ul v-else>
            <li v-for="newcontact in sortedContacts" :key="newcontact.friends_id" @click="selectContact(newcontact)" :class="{ 'selected': newcontact == selected }">
                
                <div class="contact">
                    <h4 class="name">{{ newcontact.name }}</h4> 
                   
                </div>
                <span class="unread" v-if="newcontact.unread">{{ newcontact.unread }}</span>
            </li>
        </ul>
    </div>
</template>


<script>
    export default {
        props: {
            newcontacts: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selected: this.newcontacts.length ? this.newcontacts[0] : null
            };
        },
        methods: {
            selectContact(newcontact) {
                this.selected = newcontact;

                this.$emit('selectedd', newcontact);
            }
        },
        computed: {
            sortedContacts() {
                return _.sortBy(this.newcontacts, [(newcontact) => {
                    if (newcontact == this.selected) {
                        return Infinity;
                    }

                    return newcontact.unread;
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