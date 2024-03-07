<template>

  <v-layout row>





      <v-flex class="online-users" md3  xs12>

      <v-list>
          <v-list-tile
            v-for="friend in friends"
            :color="(friend.id==activeFriend)?'green':''"
            :key="friend.id"
            @click="activeFriend=friend.id"
          >
              <v-list-tile-action >
                  <!--<v-icon :color="(onlineFriends.find(user=>user.id===friend.id))?'green':'red'"></v-icon>-->
                  <i class="icon icon-user"></i>
              </v-list-tile-action>
              <v-list-tile-content>
                  <v-list-tile-title class="text-lg-right"  v-text="friend.name"> </v-list-tile-title>
              </v-list-tile-content>


              <v-btn  sm3 fab dark  :color=" (friend.online)?'green':'blue-grey darken-3'" style="width: 15px; height:15px ">
                  <v-icon dark></v-icon>
              </v-btn>



          </v-list-tile>
        </v-list>

    </v-flex>

    <v-flex id="privateMessageBox" class="messages mb-5" md9 xs12>
        <message-list :user="user" :all-messages="allMessages"></message-list>



        <v-footer
                height="auto"
                fixed
                color="white"
                justify-center
                class="footer"
        >
            <!--<div class="floating-div">-->
                <!--<picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…" />-->

            <!--</div>-->
            <v-layout
                    justify-center
                    row
                    wrap>
                <!--<v-flex class="col-1 text-right" xs1>-->
                    <!--<v-btn @click="toggleEmo" fab dark small color="pink">-->
                        <!--<i class="icon icon-users4"> </i>-->
                    <!--</v-btn>-->
                <!--</v-flex>-->

                <v-flex class="col-1 text-right" xs1>
                    <file-upload
                            :post-action="'/private-messages/'+activeFriend"
                            ref='upload'
                            v-model="files"
                            @input-file="$refs.upload.active = true"
                            :headers="{'X-CSRF-TOKEN': token}">

                        <v-btn fab dark small color="indigo darken-4"> <i class="icon icon-attachment"> </i></v-btn>
                    </file-upload>
                </v-flex>

                <v-flex xs5 >
                    <v-text-field
                            rows=2
                            v-model="message"
                            label="اكتب رسالتك"
                            single-line
                            @keyup.enter="sendMessage"
                            right
                    ></v-text-field>
                </v-flex>

                <v-flex xs2>
                    <v-btn
                            @click="sendMessage"
                            dark class="mt-3 ml-2 white--text" small color="green">ارسال</v-btn>
                </v-flex>

            </v-layout>


        </v-footer>


    </v-flex>

  </v-layout>

</template>

<script>
  import MessageList from './_message-list'
  import { Picker } from 'emoji-mart-vue'


  export default {
    props:[
        'user',
        'userchat'

    ],
    components:{
      Picker,
      MessageList
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
          return user.id ==this.userchat;
        })
      },

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
            this.activeFriend=this.userchat;

        }

          axios.post('/private-messages/'+this.activeFriend, {message: this.message}).then(response => {
                    this.message=null;
                    this.fetchMessages();
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

                  this.activeFriend=this.userchat;

                }
            });
        },


      scrollToEnd(){
        document.getElementById('privateMessageBox').scrollTo(0,99999);
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
                    audio.play();
                    console.log('aduio');
                    console.log(e.message.user_id);
                  this.activeFriend=e.message.user_id;
                    axios.get('/users').then(response => {
                        this.users = response.data;
                        if(this.friends.length>0){
                            this.activeFriend=this.userchat;
                        }
                    });
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
