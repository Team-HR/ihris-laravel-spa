<template>
  <v-card>
    <v-card-title>
      PLANTILLA OF PERMANENT PERSONNELS
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="tableData"
      :search="search"
    ></v-data-table>
  </v-card>
</template>

<script>
  export default {
    props: {
        fetchUrl: { type: String, required: true },
    },
    data () {
      return {
        search: '',
        headers: [
            {
                text: 'No.',
                align: 'start',
                sortable: false,
                value: 'id',
            },
            { text: 'ITEM NO',value: 'item_no' },
            { text: 'POSITION TITLE',value: 'position_title' , },
            { text: 'FUNCTION',value: 'functional_title', },
            { text: 'DEPARTMENT',value: 'department' },
            { text: 'LVL',value: 'lvl' },
            { text: 'SG',value: 'sg' },
            { text: 'AUTH SALARY',value: 'auth_salary' },
            { text: 'ACTUAL SALARY',value: 'actual_salary' },
            { text: 'STEP',value: 'step' },
            { text: 'REGION CODE',value: 'region_code' },
            { text: 'AREA TYPE',value: 'area_type' },
            { text: 'CATEGORY',value: 'category' },
            { text: 'CLASSIFICATION',value: 'classification' },
            { text: 'OPTIONS',value: 'options' },

        ],
        tableData: [],
      }
    },
    created() {
     return this.fetchData(this.fetchUrl)
  },
  methods: {
    fetchData(url) {
      axios.get(url)
        .then(data => {
          this.tableData = data.data.data
          console.log(this.tableData);
        })
    },
  },



  }
</script>
