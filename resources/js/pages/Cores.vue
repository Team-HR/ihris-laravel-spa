<template>
    <v-container class="grey lighten-5">
        <v-row>
            <v-col v-for="(k, i) in 2" :key="i">
                <v-card :color="cores[i].color" tile>
                    <v-card-title>{{ cores[i].title }}</v-card-title>
                    <v-card-subtitle>{{ cores[i].subtitle }}</v-card-subtitle>
                    <v-card-text></v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col v-for="(k, i) in 2" :key="i">
                <v-card tile>
                    <v-card-title>{{ cores[i+2].title }}</v-card-title>
                    <v-card-subtitle>{{ cores[i+2].subtitle }}</v-card-subtitle>
                    <v-card-text></v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            cores: [
                {
                    color: "purple",
                    title: "RSP",
                    subtitle: "Recruitment, Selection and Planning",
                    modules: [
                        {
                            text: "Applicants",
                            path: "rsp/applicants"
                        },
                        {
                            text: "Vacant Positions",
                            path: "rsp/vacancies"
                        },
                        {
                            text: "Publications",
                            path: "rsp/publications"
                        },
                        {
                            text: "Comparative Data",
                            path: "rsp/comparatives"
                        }
                    ]
                },
                {
                    title: "L&D",
                    subtitle: "Learning and Development",
                    modules: [
                        {
                            text: "Trainings",
                            path: "lnd/trainings"
                        },
                        {
                            text: "L&D Profile",
                            path: "lnd/profile"
                        },
                        {
                            text: "L&D Plan",
                            path: "lnd/plan"
                        },
                        {
                            text: "L&D Activities",
                            path: "lnd/activities"
                        }
                    ]
                },
                {
                    title: "SPMS",
                    subtitle: "Learning and Development",
                    modules: [
                        {
                            text: "Trainings",
                            path: "lnd/trainings"
                        },
                        {
                            text: "L&D Profile",
                            path: "lnd/profile"
                        },
                        {
                            text: "L&D Plan",
                            path: "lnd/plan"
                        },
                        {
                            text: "L&D Activities",
                            path: "lnd/activities"
                        }
                    ]
                },
                {
                    title: "R&R",
                    subtitle: "Learning and Development",
                    modules: [
                        {
                            text: "Trainings",
                            path: "lnd/trainings"
                        },
                        {
                            text: "L&D Profile",
                            path: "lnd/profile"
                        },
                        {
                            text: "L&D Plan",
                            path: "lnd/plan"
                        },
                        {
                            text: "L&D Activities",
                            path: "lnd/activities"
                        }
                    ]
                }
            ]
        };
    }
};
</script>
