<template>
  <v-app id="sandbox">
    <v-navigation-drawer
      v-model="primaryDrawer.model"
      :clipped="primaryDrawer.clipped"
      :floating="primaryDrawer.floating"
      :mini-variant="primaryDrawer.mini"
      :permanent="primaryDrawer.type === 'permanent'"
      :temporary="primaryDrawer.type === 'temporary'"
      app
      overflow
    />

    <v-app-bar
      :src="appbarBgUrl"
      :clipped-left="primaryDrawer.clipped"
      app
    >
      <v-app-bar-nav-icon
        v-if="primaryDrawer.type !== 'permanent'"
        @click.stop="primaryDrawer.model = !primaryDrawer.model"
      />
      <slot name="logo"></slot>
      <v-toolbar-title>Integrated HRIS</v-toolbar-title>
    </v-app-bar>
    
    <v-content>
      <!-- <v-container fluid>
        <v-row
          align="center"
          justify="center"
        >
          <v-col cols="10"> -->
            <main class="py-5">
              <slot></slot>
            </main>
<!--           </v-col>
        </v-row>
      </v-container> -->
    </v-content>

    <v-footer
      :inset="footer.inset"
      app
    >

      <span class="px-4">&copy; {{ new Date().getFullYear() }}</span>


    </v-footer>
  </v-app>
</template>

<script>
  export default {
    props: {
      appbarBgUrl: {tpye: String}
    },
    data: () => ({
      drawers: ['Default (no property)', 'Permanent', 'Temporary'],
      primaryDrawer: {
        model: null,
        type: 'temporary',
        clipped: false,
        floating: false,
        mini: false,
      },
      footer: {
        inset: false,
      },
    }),
  }
</script>