<template>
    <v-content>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <!-- method="POST"  -->
          <v-form
            id="login-form"
            @submit="loginSubmit"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="primary"
                dark
                flat
              >
                <img :src="imgUrl" width="30" class="mr-3">
                <v-toolbar-title>Login</v-toolbar-title>
                <v-spacer />
              </v-toolbar>
              <v-card-text>

                  <input type="hidden" name="_token" :value="csrf">
                  <v-text-field
                    label="Username"
                    v-model="username"
                    name="username"
                    prepend-icon="mdi-account"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    label="Password"
                    v-model="password"
                    name="password"
                    prepend-icon="mdi-textbox-password"
                    type="password"
                  />
                
              </v-card-text>
              <v-card-actions>
                <v-spacer />
                <v-btn type="submit" color="primary">Login</v-btn>
              </v-card-actions>
            </v-card>
            </v-form>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
</template>

<script>
  export default {
    props: {
      source: String,
      imgUrl: String,
      formAction: String,
    },
    data(){
      return {
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        username: '',
        password:'',
      }
    },
    created: function(){
    },
    methods: {
      loginSubmit: function(event){
        event.preventDefault() 
        // console.log(this.username)
        // console.log(this.password)

        axios.post(this.formAction, {
          username: this.username,
          password: this.password
        })
        .then(data => {
          // console.log(data)
        })
        // .catch(function (error) {
        //   console.log(error);
        // })

      }
    }
  }
</script>
