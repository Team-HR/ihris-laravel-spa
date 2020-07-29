<template>
  <v-app-bar
    absolute
    color="indigo darken-2"
    dark
    shrink-on-scroll
    prominent
    scroll-target="#scrolling-techniques"
    app
  >
    <v-app-bar-nav-icon></v-app-bar-nav-icon>

    <v-toolbar-title>Integrated HRIS</v-toolbar-title>

    <v-spacer></v-spacer>

    <!-- <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn>

    <v-btn icon>
      <v-icon>mdi-heart</v-icon>
    </v-btn> -->

    <v-btn link icon href="" @click.prevent="$auth.logout()" v-if="$auth.check()">
      <v-icon>mdi-logout-variant</v-icon>
    </v-btn>
  </v-app-bar>
</template>

<script>
export default {
  data() {
    return {
      // routes: {
      //   // UNLOGGED
      //   unlogged: [
      //     { name: "Register", path: "register" },
      //     { name: "Login", path: "login" },
      //   ],
      //   // LOGGED USER
      //   user: [{ name: "Dashboard", path: "dashboard" }],
      //   // LOGGED ADMIN
      //   admin: [{ name: "Dashboard", path: "admin.dashboard" }],
      // },
    };
  },
  mounted() {
    console.log(this.$auth);
  },
};
</script>