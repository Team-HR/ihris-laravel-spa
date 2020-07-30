<template>
    <v-card
        class="mx-auto my-10"
        max-width="344"
        :style="{ display: success ? 'none' : '' }"
    >
        <v-card-title>
            LOGIN
        </v-card-title>
        <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                    v-model="username"
                    name="username"
                    :rules="[rules.required]"
                    label="Username"
                    required
                    type="text"
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    :append-icon="show1 ? 'mdi-eye' : 'md i-eye-off'"
                    :rules="[rules.required]"
                    :type="show1 ? 'text' : 'password'"
                    name="password"
                    label="Password"
                    hint="At least 8 characters"
                    @click:append="show1 = !show1"
                ></v-text-field>
                <v-checkbox
                    v-model="rememberMe"
                    label="Remember Me"
                ></v-checkbox>
                <v-btn
                    :disabled="!valid"
                    color="success"
                    class="mr-4"
                    @click="validate"
                    >Submit</v-btn
                >

                <v-btn color="error" class="mr-4" @click="reset">Clear</v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data: () => ({
        username: "",
        password: "",
        rememberMe: false,
        show1: false,
        valid: true,
        success: false,
        has_error: false,
        error: "",
        nameRules: [
            v => !!v || "Username is required",
            v =>
                (v && v.length <= 10) ||
                "Username must be less than 25 characters"
        ],
        rules: {
            required: value => !!value || "Required."
        }
    }),

    methods: {
        validate() {
            var validate = this.$refs.form.validate();
            return validate ? this.login() : false;
        },
        reset() {
            this.$refs.form.reset();
        },
        login() {
            // get the redirect object
            var redirect = this.$auth.redirect();
            var app = this;
            this.$auth
                .login({
                    data: {
                        username: app.username,
                        password: app.password
                    },
                    rememberMe: app.rememberMe,
                    fetchUser: true
                })
                .then(
                    res => {
                        // success
                        app.success = true;
                        const redirectTo = "dashboard";
                        this.$router.push({ name: redirectTo });
                    },
                    res => {
                        // error
                        app.has_error = true;
                        app.error = res.response.data.error;
                        console.log("error:", app.error);
                    }
                );
        }
    }
};
</script>
