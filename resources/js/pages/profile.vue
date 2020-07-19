<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-12">
        <SidebarPanel></SidebarPanel>


          <router-link :to="{ name: 'settings.profile' }" class="btn btn-success mx-auto d-block mt-2">
            <fa icon="cog" fixed-width />
            Update Profile
          </router-link>
      </div>
      <div class="col-md-9 col-12">
        <card class="postarea" :title="'Create Post'">
          <CreatePost view_post_type="1"></CreatePost>
        </card>

        <PullPost v-bind:id="user.id"></PullPost>
      </div>
    </div>
  </div>
</template>

<script>
import SidebarPanel from '~/components/SidebarPanel'
import CreatePost from '~/components/CreatePost'
import PullPost from '~/components/PullPost'

import { mapGetters } from 'vuex'

export default {
    name: 'profile',
    middleware: 'auth',
    components: {
      SidebarPanel,
      CreatePost,
      PullPost
    },
    computed: mapGetters({
        user: 'auth/user'
    }),
  metaInfo () {
    return { title: this.$t('Profile') }
  }
}
</script>

<style lang="scss" scoped>
  card.postarea {
    background-color: #f5f6f7;
  }
</style>