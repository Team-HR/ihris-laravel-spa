<template>
  <v-app-bar
    absolute
    color="indigo darken-2"
    dark
    clipped-left
    shrink-on-scroll
    prominent
    scroll-target="#scrolling-techniques"
    app
  >
    <v-app-bar-nav-icon @click.stop="toggle_drawer"></v-app-bar-nav-icon>

    <v-toolbar-title>Integrated HRIS</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon to="/">
      <v-icon>mdi-home-circle-outline</v-icon>
    </v-btn>

    <v-btn icon to="dashboard" v-if="$auth.check()">
      <v-icon>mdi-monitor-dashboard</v-icon>
    </v-btn>

    <!-- <v-btn icon to="login" v-if="!$auth.check()">
      <v-icon>mdi-login</v-icon>
    </v-btn> -->

    <v-btn link icon href @click.prevent="$auth.logout()" v-if="$auth.check()">
      <v-icon>mdi-logout</v-icon>
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
  methods: {
    toggle_drawer() {
      this.$emit("toggled_drawer");
    },
  },
  mounted() {
    // console.log(this.$auth);
  },
};
</script>