<template>
  <v-app>
    <v-card class="overflow-y-hidden">
      <v-navigation-drawer v-if="$auth.check()" app v-model="drawer" clipped>
        <!-- -->
      </v-navigation-drawer>
      
      <app-bar  @toggled_drawer="drawer = !drawer" v-if="$auth.check()"></app-bar>

      <v-sheet id="scrolling-techniques" class="overflow-y-auto" :max-height="window_height">
        <!-- Sizes your content based upon application components -->
        <v-main>
          <!-- Provides the application the proper gutter -->
          <v-container fluid :style="{'min-height': (window_height*0.85)+'px'}">
            <!-- If using vue-router -->
            <router-view></router-view>
          </v-container>
        </v-main>
      </v-sheet>
    </v-card>
  </v-app>
</template>

<script>
import AppBar from "./components/layout/AppBar.vue";
export default {
  data() {
    return {
      drawer: true,
      window_height: 720
    };
  },
  components: {
    AppBar,
  },
  mounted(){
    // console.log(window.screen.height);
    this.window_height = (window.screen.height*0.90)
    
  }
};
</script>

<style>
html,
body {
    /* margin: 0; */
    overflow: hidden !important;
}

</style>