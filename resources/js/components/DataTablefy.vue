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
        class="my-5 py-5"
      ></v-text-field>
    </v-card-title>
    <v-data-table
      dense
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
                width: 1
            },
            { text: 'ITEM NO',value: 'item_no' },
            { text: 'POSITION TITLE',value: 'position_title' , },
            { text: 'FUNCTION',value: 'functional_title', },
            { text: 'OFFICE',value: 'department' },
            { text: 'LVL',value: 'level', width: 1 },
            { text: 'SG',value: 'salary_grade' },
            { text: 'AUTH SALARY',value: 'authorized_salary' },
            { text: 'ACTUAL SALARY',value: 'actual_salary' },
            { text: 'STEP',value: 'step' },
            { text: 'REGION CODE',value: 'region_code' },
            { text: 'AREA TYPE',value: 'area_type' },
            { text: 'CATEGORY',value: 'category' },
            { text: 'CLASS',value: 'classification',width:1 },
            { text: 'OPTIONS',value: 'options', width:1 },

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
