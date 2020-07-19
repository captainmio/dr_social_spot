<template>
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-12">
          <SidebarPanel></SidebarPanel>
      </div>
      <div class="col-md-7 col-12 order-md-1 order-2">
        <card class="postarea" :title="'Create Post'">
          <CreatePost view_post_type="0"></CreatePost>
        </card>
          <PullPost></PullPost>
      </div>
      <div class="col-md-3 col-12 order-md-2 order-1">
          <h2>List of Friends</h2>
          <FetchFriends></FetchFriends>
      </div>
    </div>
  </div>
</template>

<script>
import SidebarPanel from '~/components/SidebarPanel'
import FetchFriends from '~/components/FetchFriends'
import CreatePost from '~/components/CreatePost'
import PullPost from '~/components/PullPost'

import { mapGetters } from 'vuex'

export default {
  middleware: 'auth',
  components: {
    SidebarPanel,
    FetchFriends,
    CreatePost,
    PullPost
  },
  computed: mapGetters({
      posts: 'post/posts'
  }),
  mounted: function() {
    
      
  },
  metaInfo () {
    return { title: this.$t('Home') }
  }
}
</script>

<style lang="scss" scoped>
  .postarea {
    background-color: #f5f6f7;

    @media(max-width: 768px) {
      margin-top: 30px;
    }
  }
  h2 {
    @media(max-width: 992px) {
      font-size: 22px!important;
    }
    @media(max-width: 768px) {
      margin-top: 30px;
    }
  }
</style>
