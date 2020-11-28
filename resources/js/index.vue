<template>
    <div>
        <nav class="navbar bg-white border-bottom navbar-light mb-1">
        <router-link v-if="!isLoggedIn" class="nav-link ml-auto" :to="{name: 'login'}">Login</router-link>
        <a v-if="isLoggedIn" class="nav-link ml-auto" href="#" @click="logOut">Logout</a>
        </nav>
        <div class="mt-2 mb-2 pr-2 pl-2"><router-view></router-view></div>
    </div>
</template>

<script>
import { mapState } from "vuex";
export default {
    computed: {
        ...mapState({
            isLoggedIn: "isLoggedIn"
        })
    },
    methods: {
         async logOut() {
            try {
                 axios.post('/logout');
                this.$store.dispatch('logout');
                this.$router.push('/');
            } catch (error) {
                this.$store.dispatch('logout');
            }

        }
    }
}
</script>