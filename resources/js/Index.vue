<template>
  <v-app>
    <v-card class="overflow-y-hidden">
      <v-navigation-drawer app>
        <!-- -->
      </v-navigation-drawer>
      
      <Menu></Menu>

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
import Menu from "./components/Menu.vue";
export default {
  data() {
    return {
      window_height: 720
    };
  },
  components: {
    Menu,
  },
  mounted(){
    console.log(window.screen.height);
    this.window_height = (window.screen.height*0.90)
    
  }
};
</script>