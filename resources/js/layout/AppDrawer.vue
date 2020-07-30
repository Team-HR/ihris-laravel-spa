<template>
    <v-navigation-drawer
        v-model="drawn"
        :clipped="$vuetify.breakpoint.lgAndUp"
        app
    >
        <v-list dense>
            <template v-for="item in items">
                <v-row v-if="item.heading" :key="item.heading" align="center">
                    <v-col cols="12">
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-col>
                    <!-- <v-col cols="6" class="text-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-col> -->
                </v-row>
                <v-list-group
                    v-else-if="item.children"
                    :key="item.text"
                    v-model="item.model"
                    :prepend-icon="item.model ? item.icon : item['icon-alt']"
                    append-icon=""
                >
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ item.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </template>
                    <v-list-item
                        v-for="(child, i) in item.children"
                        :key="i"
                        link
                    >
                        <v-list-item-action v-if="child.icon">
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ child.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
                <v-list-item v-else :key="item.text" link :to="item.path">
                    <v-list-item-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>
                            {{ item.text }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    props: {
        drawn: Boolean
    },
    data() {
        return {
            items: [
                { heading: "Navigation" },
                { icon: "mdi-view-dashboard", text: "Dash", path: '/dashboard'},
                { icon: "mdi-account-details-outline", text: "Profile", path: '/profile'},
                { icon: "mdi-view-dashboard", text: "HR Cores", path: '/cores'},
                { heading: "System Administration" },
                { icon: "mdi-account-settings-outline", text: "Accounts Management", path: "/sysadmin/accounts/management" },
                { icon: "mdi-content-copy", text: "Duplicates" },
                {
                    icon: "mdi-chevron-up",
                    "icon-alt": "mdi-chevron-down",
                    text: "Labels",
                    model: true,
                    children: [{ icon: "mdi-plus", text: "Create label" }]
                },
                {
                    icon: "mdi-chevron-up",
                    "icon-alt": "mdi-chevron-down",
                    text: "More",
                    model: false,
                    children: [
                        { text: "Import" },
                        { text: "Export" },
                        { text: "Print" },
                        { text: "Undo changes" },
                        { text: "Other contacts" }
                    ]
                },
                { icon: "mdi-cog", text: "Settings" },
                { icon: "mdi-message", text: "Send feedback" },
                { icon: "mdi-help-circle", text: "Help" },
                { icon: "mdi-cellphone-link", text: "App downloads" },
                { icon: "mdi-keyboard", text: "Go to the old version" }
            ]
        };
    },
    mounted() {}
};
</script>
