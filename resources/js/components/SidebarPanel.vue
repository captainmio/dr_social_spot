<template>
    <div>
        <img :src="user.photo_url" class="rounded-circle profile-photo mr-1 mx-auto d-block w-100"><br>
              <strong class="text-center d-block">{{ user.name }}</strong>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'SidebarPanel',
    computed: mapGetters({
        user: 'auth/user'
    })
}
</script>

<style>

</style>