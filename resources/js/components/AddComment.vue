<template>
    <div>
        <textarea v-model="body" class="d-inline-block" ></textarea>
        <button class="ml-auto d-block btn btn-primary btn-sm" @click="addComment()">Comment</button>
    </div>
</template>

<script>
export default {
    name: 'AddComment',
    props: ['post'],
    data: function() {
        return {
            body: null
        }
    },
    methods: {
        addComment() {
            // create a comment to this post
            this.$store.dispatch('post/addComment', {
                post_id: this.post.post_id,
                comment_id: this.post.comment_id,
                body: this.body,
            }).then(response => {
                this.body = null;
                this.$store.dispatch('post/pullAllPosts', {id: 0});
                
                // this.$store.dispatch('post/pullReplies', {
                //     post_id: this.post.post_id,
                //     parent_id: this.post.comment_id,
                //     user_id: this.post.user_id,
                // });


                this.$emit('update-replies', true);
            });
            
        }
    }
}
</script>

<style lang="scss" scoped>
    textarea{
        resize: none;
        margin-top: 10px;
        width: 90%;
        margin-left: auto;
        display: block!important;
        margin-top: 20px;
    }
</style>