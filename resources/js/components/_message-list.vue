<template>
    <div>
        <v-list
                class="p-3"
                v-for="(message, index) in allMessages"
                :key="index"
                v-bind:class="(user.id==message.user_id)?'text-left': 'text-right'    "
        >
            <div class="message-wrapper">
                <v-flex>
                    <span class="small font-italic">{{message.user.name}}  </span>
                </v-flex>


                <div v-if="message.message" class="text-message-container">
                    <v-chip :color="(user.id==message.user_id)?'red':'green'" text-color="white">
                        {{message.message}}

                    </v-chip>

                </div>

                <div class="image-container">
                    <a target="_blank" :href="'/storage/'+message.image">
                        <img width="250px" v-if="message.image" :src="'/storage/'+message.image"
                             :class="(isImage(message.image))?'':'d-none'" alt="">
                        <i v-if="message.image" class="image-name"
                           :class="(isImage(message.image))?'d-none':''">{{message.image_name}}</i>
                        <i v-if="message.image"
                           :class="(isImage(message.image))?'d-none':''" class="icon icon-file-download"> </i>
                    </a>
                </div>

                <v-flex class="caption font-italic">
                    {{message.created_at}}
                </v-flex>
            </div>


        </v-list>

    </div>
</template>

<script>
    import isImage from 'is-image'

    export default {
        props: ['user', 'allMessages'],
        d_none: {
            display: 'none',
        },
        methods: {
            isImage: isImage
        }
    }
</script>

<style scoped>
    .chat-card {
        margin-bottom: 140px;
    }
    .image-name {
              background-color: #999999;
              text-decoration: underline;
              color: black;
              box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .3);
              border-radius: 73px;
              padding:0 10px 0 10px;
    }

    .floating-div {
        position: fixed;
    }

    .chat-card img {
        max-width: 300px;
        max-height: 200px;
    }

    .image-container img {
        max-width: 300px;
        max-height: 200px;
    }

</style>
