<template>
  <div class="container">
    <div class="row">
      <div class="col-2">
          <SidebarPanel></SidebarPanel>
      </div>
      <div class="col-7">
        <card class="postarea" :title="'Create Post'">
          <CreatePost></CreatePost>
        </card>
      </div>
      <div class="col-3">
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

export default {
  middleware: 'auth',
  components: {
    SidebarPanel,
    FetchFriends,
    CreatePost
  },
  metaInfo () {
    return { title: this.$t('Home') }
  }
}
</script>

<style lang="scss" scoped>
  card.postarea {
    background-color: #f5f6f7;
  }

</style>
