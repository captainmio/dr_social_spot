<template>
    <div>
        <textarea placeholder="Post something here..." class="w-100 p-2" v-model="post">
            
        </textarea>
        <button class="btn btn-primary d-block ml-auto" @click="createPost()">Post</button>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'CreatePost',
    data: function() {
        return {
            post: null
        }
    },
    props: ['view_post_type'],
    computed: mapGetters({
        user: 'auth/user'
    }),
    methods: {
        createPost() {
            // check if post model is not null
            if(this.post !== null || this.post !== undefined) {
                // execute API to create a post
                this.$store.dispatch('post/createPost', {
                    post: this.post,
                    user_id: this.user.id
                }).then(response => {
                    if(isNaN(response)) {
                        // execute pulling of your latest post
                        if(this.view_post_type == 1) {
                            this.$store.dispatch('post/pullAllPosts', {id: this.user.id});
                        } else {
                            this.$store.dispatch('post/pullAllPosts', {id: 0});
                        }
                        
                    }
                })
            }
            
            
            this.post = null;
        }
    }
}
</script>

<style lang="scss" scoped>
    textarea {
        resize: none;
        height: 80px;
    }
</style>