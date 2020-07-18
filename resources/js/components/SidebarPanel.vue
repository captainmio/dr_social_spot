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

<style lang="scss" scoped>
    img {
        @media(max-width: 768px) {
            width: 75%!important;
        }
    }

    strong {
        @media(max-width: 768px) {
            font-size: 30px;
        }
    }
</style>