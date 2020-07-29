<template>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-text-field
            v-model="username"
            name="username"
            :rules="[rules.required, rules.min]"
            label="Username"
            required
            type="text"
        ></v-text-field>
        <v-text-field
            v-model="password"
            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
            :rules="[rules.required, rules.min]"
            :type="show1 ? 'text' : 'password'"
            name="password"
            label="Password"
            hint="At least 8 characters"
            @click:append="show1 = !show1"
        ></v-text-field>
        <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="validate"
        >
            Submit
        </v-btn>

        <v-btn color="error" class="mr-4" @click="reset">
            Clear
        </v-btn>
    </v-form>
</template>

<script>
export default {
    data: () => ({
        password: "",
        show1: false,
        valid: true,
        username: "",
        nameRules: [
            v => !!v || "Username is required",
            v =>
                (v && v.length <= 10) ||
                "Username must be less than 25 characters"
        ],
        rules: {
          required: value => !!value || 'Required.',
          min: v => (v && v.length >= 8) || 'Min 8 characters',
          // emailMatch: () => ('The email and password you entered don\'t match'),
        },
    }),

    methods: {
        validate() {
            this.$refs.form.validate();
        },
        reset() {
            this.$refs.form.reset();
        }
    }
};
</script>
