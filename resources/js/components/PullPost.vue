<template>
  <div class="postbody">
      <div class="post" v-for="post in posts" :key="post.id">
        <strong>{{ post.user.name }}</strong> 
        <p>{{ post.content }}</p>
        No. of likes: {{ post.postlike.length }} <i class="float-right d-inline-block">{{ post.created_at | moment("dddd, MMMM Do YYYY") }}</i><br>
        <button class="text-left d-inline-block btn btn-primary btn-sm" @click="likeEvent(post.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i>like</button>
      
        <div v-if="post.user.id === user.id">
            <p>You can comment</p>
        </div>
      </div>
      
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'PullPost',
    props: {
        id: {
            type: Number,
            default: 0
        }
    },
    computed: mapGetters({
        posts: 'post/posts',
        user: 'auth/user'
    }),
    methods: {
        likeEvent(post_id) {
            // do adding/removing of like to a post
            this.$store.dispatch('post/likeAPost', {post_id: post_id}).then(response => {
                // update all list of post
                this.$store.dispatch('post/pullAllPosts', {id: 0});
            });
            
        }
    },
    mounted: function() {
        this.$store.dispatch('post/pullAllPosts', {id: this.id});
    }
}
</script>

<style lang="scss" scoped>
    .postbody{
            padding: 15px;

        .post{
            border-radius: 5px;
            background: #FFF;
            border-left: 2px solid #4267B2;
            padding: 15px;
            padding-left: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    }
</style>