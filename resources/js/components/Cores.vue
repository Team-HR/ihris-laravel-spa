<template>

<v-container class="grey lighten-5">
    <v-row no-gutters justify="center">
      <template v-for="(core, n) in cores">
        <v-col :key="n++" md="4">


<v-hover 
        v-slot:default="{ hover }"
        open-delay="100"
>
<v-card
    :elevation="hover ? 16 : 2"
    class="ma-2"
    outlined
    :color="core.color"
    :dark="core.dark"
    min-height=""
>
    <!-- <v-img cols="6" src="images/cores/rsp-cover.jpg" max-width="781.5" max-height="200"></v-img> -->
    <v-list-item two-line >
      <v-list-item-content>
        <div class="overline mb-4">{{ core.overline }}</div>
        <v-list-item-title class="headline mb-1">{{ core.headline }}</v-list-item-title>
        <v-list-item-subtitle>
          {{ core.description}}
        </v-list-item-subtitle>
      </v-list-item-content>
    
      <v-list-item-avatar
        tile
        size="80"
      ><img :src="core.img"></v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn text :href="core.href" class="mr-2"> <v-icon left>mdi-gauge</v-icon>Dashboard</v-btn>
        <v-menu
          transition="slide-x-transition"
          :close-on-click="true"
          :close-on-content-click="false"
        >
        <template v-slot:activator="{ on }">
          <v-btn text v-on="on"><v-icon left>mdi-arrow-down-drop-circle-outline</v-icon>Quick Links</v-btn> 
        </template>
        <v-list subheader>
            <v-subheader>Quick Links</v-subheader>
            <v-list-item
              v-for="(link, i) in core.links"
              :key="i"
              :href="link.href"
              link
            >
              <v-list-item-title>
                {{ link.title }}
              </v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-card-actions>
    </v-card>
    
</v-hover>
        </v-col>
        <v-responsive
          v-if="n === 2"
          :key="`width-${n}`"
          width="100%"
        ></v-responsive>
      </template>
    </v-row>


  </v-container>
  
</template>

</template>
<script>
    export default {
        data: () => ({
            cores: [
                {
                    overline: 'Recruitment, Selection and Placement',
                    headline: 'RSP',
                    description: '',
                    href:'',
                    img: 'images/cores/rsp.png',
                    color: '#ff7b00',
                    dark: true,
                    links: [
                        {title: 'Compartive Data', href:''},
                        {title:'Individual Turn Around Time', href:''},
                        {title:'System of Ranking Position', href:''},
                        {title:'Staffing Plan', href:''},
                        {title:'Turn Around Time', href:''},
                        {title:'Personnel Competency Encode', href:''},
                        {title:'Personnel Competency Form', href:''},
                        {title:'Personnel Competency Report', href:''},
                    ]
                },
                {
                    overline: 'Learning and Development',
                    headline: 'L&D',
                    description: '',
                    href:'',
                    img: 'images/cores/lnd.png',
                    color: '#00b3ff',
                    dark: true,
                    links: [
                        {title: 'Invitation/Communications', href:''},
                        {title: 'Training Schedule/Evaluation', href:''},
                        {title:'L&D Profile', href:''},
                        {title:'L&D Plan', href:''},
                        {title:'L&D Activities', href:''},
                        {title:'L&D Training Needs Assessment', href:''},
                        {title:'Training Report', href:''},
                        {title:'Talent Assessment Report', href:''},
                    ]
                },
                {
                    overline: 'Strategic Performance Monitoring System',
                    headline: 'SPMS',
                    description: '',
                    href:'',
                    img: 'images/cores/spms.png',
                    color: '#00d427',
                    dark: true,
                    links: [
                        {title: 'Performance Rating Report',href:''},
                        {title: 'Coaching and Mentoring Report',href:''}
                    ]
                },
                {
                    overline: 'Rewards and Recognition',
                    headline: 'R&R',
                    description: '',
                    href:'',
                    img: 'images/cores/rnr.png',
                    color: '#ffd500',
                    dark: true,
                    links: [
                        {title: 'Personnel Recognition',href:''}
                    ]
                }
            ]
        }),
        mounted() {
            // console.log('Home Component mounted.')
        }
    }
</script>
