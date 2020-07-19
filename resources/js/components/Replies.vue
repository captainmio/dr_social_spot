<template>
  <div>
    <div class="ml-4" v-for="reply in replies" :key="reply.id">
        <strong class="d-inline-block">{{ reply.user.name }}</strong>
        <i class="d-inline-block float-right">{{ reply.created_at | moment("dddd, MMMM Do YYYY") }}</i>
        <div class="ml-2" style="height: 100%;">
            <p>{{ reply.body }}</p> 
        </div>
    </div>

    <button class="btn_small float-right d-block" @click="com_toggle = !com_toggle">Reply</button><br>
     <AddComment v-if="com_toggle" v-bind:post="{
        post_id: this.reply.post_id,
        comment_id: this.reply.comment_id,
        user_id: this.reply.id
    }" @update-replies="callReplies"></AddComment>
  </div>
</template>

<script>
import AddComment from '~/components/AddComment'

export default {
    name: 'Replies',
    props: ['reply'],
    data: function() {
        return {
            replies: [],
            com_toggle: false,
        }
    },
    components: {
        AddComment
    },
    methods: {
        callReplies() {
            this.$store.dispatch('post/pullReplies', {
                post_id: this.reply.post_id,
                parent_id: this.reply.comment_id,
                user_id: this.reply.user_id,
            }).then(response => {
                this.replies = response.data;
                
            });
        }
    },
    mounted: function() {
        this.callReplies();
        var self = this;

        // i have to use setInterval because the backend cannot implement real-time data presence like firetore/node socket.io... but in the future this might be need to be updated
        setInterval(function() {
            self.callReplies();
        }, 10 * 1000);
    }
}
</script>

<style land="scss" scoped>
    .btn_small {
        color: #fff;
        background-color: rgb(66,103,178);
        border-color: rgb(66,103,178);
    }
</style>