<template>
    <v-app>
        <v-card class="overflow-y-hidden">
            <app-drawer
                :drawn = "drawer"
                v-if="$route.path !== '/login'"
            ></app-drawer>
            
            <app-bar
                @toggled_drawer="drawer = !drawer"
                v-if="$route.path !== '/login'"
            ></app-bar>

            <v-sheet
                id="scrolling-techniques"
                class="overflow-y-auto"
                :max-height="window_height"
            >
                <!-- Sizes your content based upon application components -->
                <v-main>
                    <!-- Provides the application the proper gutter -->
                    <v-container
                        fluid
                        :style="{ 'min-height': window_height * 0.85 + 'px' }"
                    >
                        <!-- If using vue-router -->
                        <!-- <transition> -->
                            <router-view></router-view>
                        <!-- </transition> -->
                    </v-container>
                </v-main>
            </v-sheet>
        </v-card>
    </v-app>
</template>

<script>
import AppBar from "./layout/AppBar.vue";
import AppDrawer from "./layout/AppDrawer.vue";
export default {
    data() {
        return {
            transitionName: "",
            drawer: true,
            window_height: 720
        };
    },
    components: {
        AppBar, AppDrawer
    },
    mounted() {
        this.window_height = window.screen.height * 0.9;
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
