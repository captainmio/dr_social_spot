<template>
  <div>
      <ul>
          <li v-for="friend in friends" :key="friend.id">
              {{ friend.name }}
          </li>
      </ul>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'FetchFriends',
    computed: mapGetters({
        friends: 'user/friends'
    }),
    mounted: function() {
        this.$store.dispatch('user/fetchFriends')
    }
}
</script>

<style lang="scss" scoped>
    ul {
        list-style-type:none;
        margin-left: -40px;
        li {
            font-size: 16px;
        }
    }
</style>