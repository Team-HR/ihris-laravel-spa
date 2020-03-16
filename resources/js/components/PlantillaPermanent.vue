<template>
  <v-data-table
    :headers="headers"
    :items="tableData"
    :search="search"
    sort-by="calories"
    class="elevation-1"
  > 
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>PLANTILLA OF PERMANENT EMPLOYEES</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-text-field
          class="my-5"
          v-model="search"
          clearable
          prepend-icon="mdi-magnify"
          label="Search"
          single-line
          hide details
        ></v-text-field>

        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-dialog 
          v-model="dialog" 
          max-width="1000px"
          persistent
          app
        >
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">New Plantilla</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="2" md="2">
                    <v-text-field
                      error
                      error-message="Item number already existing, must be unique."
                      v-model="editedItem.item_no" label="Item no."></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="5" md="5">
                    <v-text-field v-model="editedItem.position_title" label="Position Title"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm=5 md="5">
                    <v-text-field v-model="editedItem.functional_title" label="Functional Title"></v-text-field>
                  </v-col>
                  </v-row>  
                <v-row>
                  <v-col cols="12" sm="6" md="6">
                      <v-select
                        v-model="editedItem.department_id"
                        :items="departments"
                        item-text="name"
                        item-value="id"
                        label="Department"
                      ></v-select>
                  </v-col>
                  <v-col cols="12" sm="1" md="1">
                    <v-text-field v-model="editedItem.level" label="Level"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="1" md="1">
                    <v-text-field v-model="editedItem.salary_grade" label="SG"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="2" md="2">
                    <v-text-field v-model="editedItem.authorized_salary" label="Authorized Salary"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="2" md="2">
                    <v-text-field v-model="editedItem.actual_salary" label="Actual Salary"></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12" sm="1" md="1">
                    <v-text-field v-model="editedItem.step" label="Step"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="1" md="1">
                    <v-text-field v-model="editedItem.region_code" label="Region Code"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="2" md="2">
                    <v-text-field v-model="editedItem.area_type" label="Area Type"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="2" md="2">
                    <v-text-field v-model="editedItem.category" label="Category"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="2" md="2">
                    <v-text-field v-model="editedItem.classification" label="Classification"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.number="{ item }">
     {{tableData.map(function(x) {return x.id; }).indexOf(item.id)+1}}
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="fetchData()">Reset</v-btn>
    </template>
  </v-data-table>
</template>
<script>

  const qs = require('qs');
  export default {
    // props: {
    //     fetchUrl: { type: String, required: true },
    // },
    data () {
      return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      dialog: false,
        search: '',
        headers: [
            {
                text: 'No.',
                align: 'start',
                sortable: false,
                value: 'number',
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
            { text: 'ACTIONS',value: 'actions', sortable: false},
        ],
      tableData: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        item_no: '',
        position_title: '',
        functional_title: '',
        department_id: '',
        level: '',
        salary_grade: '',
        authorized_salary: '',
        actual_salary: '',
        step: '',
        region_code: '',
        area_type: '',
        category: '',
        classification: '',
      },
      defaultItem: {
        id: null,
        item_no: '',
        position_title: '',
        functional_title: '',
        department_id: '',
        level: '',
        salary_grade: '',
        authorized_salary: '',
        actual_salary: '',
        step: '',
        region_code: '',
        area_type: '',
        category: '',
        classification: '',
      },
      departments:[]
      }
    },

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Plantilla' : 'Edit Plantilla'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.fetchData()
      axios.get('departments-list')
            .then(data => {
              this.departments = data.data.data
              console.log(this.departments);
            })
    },

    methods: {
      fetchData() {
          axios.get('plantilla_permanents/data-table')
            .then(data => {
              this.tableData = data.data.data
              console.log(this.tableData);
            })
      },

      editItem (item) {
        this.editedIndex = this.tableData.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        const index = this.tableData.indexOf(item)
        confirm('Are you sure you want to delete this item?') && this.tableData.splice(index, 1)
      },

      close () {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save () {
        if (this.editedIndex > -1) {
          // Edit Existing
          axios.post('plantilla_permanents', {
            data: this.editedItem,
          })
          .then(data => {
            
            if (typeof data.data.error == 'undefined') {
                console.log('new no error');
                Object.assign(this.tableData[this.editedIndex], this.editedItem)
                this.close();
              } else {
                console.log('new with error');
                console.log(data.data.error);
              }

          });
        } else {
          // Add New
          axios.post('plantilla_permanents', {
            data: this.editedItem,
          })
          .then(
            data => {

              if (typeof data.data.error == 'undefined') {
                this.editedItem.id = data.data.id;
                this.tableData.push(this.editedItem);
                console.log('new no error',this.editedItem);
              } else {
                console.log('new with error');
                console.log(data.data.error);
              }

            }
              
          );
        }
      },
    },
  }
</script>