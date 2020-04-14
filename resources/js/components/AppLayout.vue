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

    >

    <template v-slot:prepend>
        <v-list-item two-line>
          <v-list-item-avatar>
            <img src="data:image/png;base64,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">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>
              <slot name="user"></slot>
            </v-list-item-title>
            <v-list-item-subtitle>Logged In</v-list-item-subtitle>
          </v-list-item-content>

            <v-list-item-action>
            
<form id="logout-form" action="logout" method="POST" style="display: none;">
    <slot name="csrf"></slot>
</form>

              <v-btn icon title="Logout" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <v-icon>mdi-login-variant</v-icon>
              </v-btn>
              

            </v-list-item-action>
          
        </v-list-item>
    </template>

      <v-divider></v-divider>

      <v-list>
        <v-list-item-group v-model="item" color="primary">
          <v-list-item
            v-for="item in items"
            :key="item.title"
            :href="item.href"
          >
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>

    </v-navigation-drawer>

    <v-app-bar
      src="images/circuitboardbg.gif"
      :clipped-left="primaryDrawer.clipped"
      app
    >
      <v-app-bar-nav-icon
        v-if="primaryDrawer.type !== 'permanent'"
        @click.stop="primaryDrawer.model = !primaryDrawer.model"
      />
      <!-- <v-btn href="home" icon>
        <img src="favicon.ico" width="30">
      </v-btn> -->
      <v-toolbar-title>
        <v-btn link text
          href="cores"
        >
          <img src="favicon.ico" width="30" class="mr-2">
          Integrated HRIS
        </v-btn>
        </v-toolbar-title>
    </v-app-bar>
    
    <v-content>
      <v-container
        fluid
      >
        <slot></slot>  
      </v-container>
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
    watch: {
      item: function (val,oldVal){
        console.log('new: %s, old: %s', val, oldVal)
      }
    },
    data: () => ({
      drawers: ['Default (no property)', 'Permanent', 'Temporary'],
      primaryDrawer: {
        model: null,
        type: 'Default (no property)',
        clipped: false,
        floating: false,
        mini: false,
      },
      footer: {
        inset: false,
      },
      item: 1,
      items: [
        {
          icon:'mdi-account-box-multiple',
          title:'Employees',
          href:'home'
        },
        {
          icon:'mdi-home',
          title:'Home',
          href:'home'
        },
      ]
    }),
  }
</script>