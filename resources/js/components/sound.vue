<template>



</template>

<script>

    import Toasted from 'vue-toasted';
    import   'material-design-icons';
    Vue.use(Toasted)


  export default {
    props:[
        'user',

    ],
    components:{


    },

    data () {
      return {
        message:null,
         files:[],
        activeFriend:null,
        typingFriend:{},
        onlineFriends:[],
        allMessages:[],
        typingClock:null,
        emoStatus:false,
        users:[],
        token:document.head.querySelector('meta[name="csrf-token"]').content

      }
    },

    computed:{
      friends(){
        return this.users.filter((user)=>{
          return user.id !==this.user.id;
        })
      }
    },

    watch:{
      files:{
        deep:true,
        handler(){
          let success=this.files[0].success;
          if(success){
            this.fetchMessages();
          }
        }
      },
      activeFriend(val){
        this.fetchMessages();
      },
      '$refs.upload'(val){
        console.log(val);
      }
    },

    methods:{
      onTyping(){
        Echo.private('privatechat.'+this.activeFriend).whisper('typing',{
          user:this.user
        });
      },
      sendMessage(){

        //check if there message
        if(!this.message){
          return alert('Please enter message');
        }
        if(!this.activeFriend){
          return alert('Please select friend');
        }

          axios.post('/private-messages/'+this.activeFriend, {message: this.message}).then(response => {
                    this.message=null;
                    this.allMessages.push(response.data.message)
                    setTimeout(this.scrollToEnd,100);
          });
      },
      fetchMessages() {
         if(!this.activeFriend){
          return alert('Please select friend');
        }
            axios.get('/private-messages/'+this.activeFriend).then(response => {
                this.allMessages = response.data;
              setTimeout(this.scrollToEnd,100);

            });
        },
      fetchUsers() {
            axios.get('/users').then(response => {
                this.users = response.data;
                if(this.friends.length>0){
                  this.activeFriend=this.friends[0].id;

                }
            });
        },


      scrollToEnd(){

      },
      toggleEmo(){
        this.emoStatus= !this.emoStatus;
      },
      onInput(e){
        if(!e){
          return false;
        }
        if(!this.message){
          this.message=e.native;
        }else{
          this.message=this.message + e.native;
        }
        this.emoStatus=false;
      },

      onResponse(e){
        console.log('onrespnse file up',e);
      }


    },

    mounted(){
    },

    created(){
              this.fetchUsers();

              Echo.join('sheari')
              .here((users) => {
                   console.log('online',users);
                   this.onlineFriends=users;
              })
              .joining((user) => {
                  this.onlineFriends.push(user);
                  console.log('joining',user.name);
              })
              .leaving((user) => {
                  this.onlineFriends.splice(this.onlineFriends.indexOf(user),1);
                  console.log('leaving',user.name);
              });

              let audio = new Audio("https://notificationsounds.com/soundfiles/1728efbda81692282ba642aafd57be3a/file-sounds-1101-plucky.wav");

              Echo.private('privatechat.'+this.user.id)
                .listen('PrivateMessageSent',(e)=>{
                    this.$toasted.show("لديك رسالة جديدة   : "+ e.message.message, {
                        theme: "toasted-primary",
                        position: "bottom-left",
                        duration: 10000,
                    });
                    audio.play();
                  this.activeFriend=e.message.user_id;
                  this.allMessages.push(e.message)
                  setTimeout(this.scrollToEnd,100);

              })
              .listenForWhisper('typing', (e) => {

                  if(e.user.id==this.activeFriend){

                      this.typingFriend=e.user;

                    if(this.typingClock) clearTimeout();

                      this.typingClock=setTimeout(()=>{
                                            this.typingFriend={};
                                        },9000);
                  }



            });

    }

  }
</script>

<style  >
    .v-input .v-label {
        height: 20px;
        line-height: 20px;
        right: 0 !important;
        left: auto !important;
        color: grey;
    }
    </style>
    <style scoped>
        .footer{
            box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .3); padding-right: 350px
        }
    .v-input .v-label {
        height: 20px;
        line-height: 20px;
        right: 0 !important;
        left: auto !important;
    }
.online-users,.messages{
    overflow-y:scroll;
    height:50vh;
    box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .3);
    padding: 10px;
    background-color:white;
}
    .online-users{
        margin-left:10px
    }

img{
     width: 30px;
     max-height: 20px;
 }

</style>
