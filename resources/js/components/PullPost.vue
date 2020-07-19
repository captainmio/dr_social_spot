<template>
  <div class="postbody">
      <div class="post" v-for="post in posts" :key="post.id">
        <strong>{{ post.user.name }}</strong> 
         <i class="float-right d-inline-block">{{ post.created_at | moment("dddd, MMMM Do YYYY") }}</i>
        <p>{{ post.content }}</p>
        No. of likes: {{ post.postlike.length }}<br>
        <button class="text-left d-inline-block btn btn-primary btn-sm" @click="likeEvent(post.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i>like</button>
        <button class="text-left d-inline-block btn btn-primary btn-sm" @click="showComment(post.id)"><i class="fa fa-thumbs-up" aria-hidden="true"></i>Comment</button>
        
        <div class="ml-3 mt-3" v-for="comment in post.comments" :key="comment.id">
            <strong class="d-inline-block">{{ comment.user.name }}</strong>
            <i class="d-inline-block float-right">{{ comment.created_at | moment("dddd, MMMM Do YYYY") }}</i>
            <div class="ml-2" style="height: 100%;">
                <p>{{ comment.body }}</p> 
            </div>
                <Replies v-bind:reply="{
                    post_id: post.id,
                    comment_id: comment.id,
                    user_id: comment.user.id
                }"></Replies>
                <!-- <button class="btn_small float-right d-block" @click="showChild(comment.id)">Reply</button><br>
                <AddComment v-if="child_comment == comment.id" v-bind:post="{
                    post_id: post.id,
                    comment_id: comment.id,
                    user_id: comment.user.id
                }" ></AddComment> -->
        </div>

        <AddComment v-if="primary_comment == post.id" v-bind:post="{
            post_id: post.id,
            comment_id: 0
        }"></AddComment>
      </div>
      
  </div>
</template>

<script>
import AddComment from '~/components/AddComment'
import PullPost from '~/components/PullPost'
import Replies from '~/components/Replies'
import { mapGetters } from 'vuex'

export default {
    name: 'PullPost',
    props: {
        id: {
            type: Number,
            default: 0
        }
    },
    data: function () {
        return {
            primary_comment: 0,
            child_comment: 0
        }
    },
    components: {
        AddComment,
        PullPost,
        Replies
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
            
        },
        showComment(post_id) {
            this.primary_comment = post_id;
        },
        showChild(comment_id) {
            this.child_comment = comment_id;
        }
    },
    mounted: function() {
        this.$store.dispatch('post/pullAllPosts', {id: this.id});

        // get post every 1 minute
        var self = this.$store
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