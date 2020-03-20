<template>
  <v-data-table app :headers="headers" headers:align="center" :items="tableData" :search="search" sort-by="calories"
    class="elevation-1 masterTable" dense>

    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>PLANTILLA OF PERMANENT EMPLOYEES</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-text-field class="my-5" v-model="search" clearable prepend-icon="mdi-magnify" label="Search" single-line hide
          details></v-text-field>

        <v-divider class="mx-4" inset vertical></v-divider>
        <v-dialog v-model="dialog" max-width="1000px" persistent app>
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
                    <v-text-field v-model="editedItem.item_no" label="Item no."></v-text-field>
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
                    <v-select v-model="editedItem.department_id" :items="departments" item-text="name" item-value="id"
                      label="Department"></v-select>
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
              <v-btn color="red" text @click="close">Cancel</v-btn>
              <v-btn color="blue" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>

      <v-dialog v-model="delete_dialog" max-width="500px" persistent app>

        <!-- delete dialog start -->
        <v-card>
          <v-card-title>
            <span class="headline">Delete</span>
          </v-card-title>
          <v-card-text>
            <p>Are your sure you want to delete this item?</p>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red" text @click="delete_dialog = !delete_dialog">Cancel</v-btn>
            <v-btn color="blue" text @click="execDelete">Confirm</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <!-- delete dialog end -->


      <!-- snackbar start -->
      <v-snackbar v-model="snackbar.snackbar" :bottom="snackbar.y === 'bottom'" :color="snackbar.color"
        :left="snackbar.x === 'left'" :multi-line="snackbar.mode === 'multi-line'" :right="snackbar.x === 'right'"
        :timeout="snackbar.timeout" :top="snackbar.y === 'top'" :vertical="snackbar.mode === 'vertical'">
        {{ snackbar.text }}
        <v-btn dark text @click="snackbar.snackbar = false">
          Close
        </v-btn>
      </v-snackbar>
      <!-- snackbar end -->


      <!-- appoint dialog start -->
      <v-dialog v-model="appoint_dialog" width="500px" persistent>
        <v-card>
          <v-card-title>
            <span class="headline">Appoint</span>
          </v-card-title>
          
          <v-card-text>






























            <!-- <v-container> -->
              <v-autocomplete :readonly="(appoint?false:true)" :items="employees" item-text="full_name" item-value="id" dense :label="(appoint?'Select employee':'Appointed Employee')" outlined placeholder="Appoint employee"></v-autocomplete>
              <v-menu
                ref="menu"
                v-model="menu"
                :close-on-content-click="false"
                :return-value.sync="date"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="date"
                    :label="appoint?'Date Appointed':'Date Vacated'"
                    :prepend-icon="appoint?'mdi-calendar-import':'mdi-calendar-export'"
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="date" no-title scrollable>
                  <v-spacer></v-spacer>
                  <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                  <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                </v-date-picker>
              </v-menu>
              <v-spacer></v-spacer>
              <v-slide-x-reverse-transition
                mode="out-in"
              >
              <v-btn :key="`btn-${appoint}`" v-model="appoint" right :color="(appoint?'green':'red')" text @click="appoint = !appoint">{{(appoint?'Appoint':'Vacate')}}</v-btn>
              </v-slide-x-reverse-transition>
              <v-subheader>Appointment Hisory</v-subheader>


              <div class="twoLineList">
              <v-list two-line>
                <v-list-item-group
                  v-model="selected"
                >
                  <template v-for="(item, index) in appointHistory">
                    <v-list-item :key="item.title">
                      <template v-slot:default="{ active, toggle }">
                        <v-list-item-content>
                          <v-list-item-title v-text="item.title"></v-list-item-title>
                          <!-- <v-list-item-subtitle class="text--primary" v-text="item.headline"></v-list-item-subtitle> -->
                          <v-list-item-subtitle v-text="item.subtitle"></v-list-item-subtitle>
                        </v-list-item-content>
          
                        <v-list-item-action>
                          <v-list-item-action-text v-text="item.action"></v-list-item-action-text>
                          <v-icon
                            v-if="!active"
                            color="grey lighten-1"
                          >
                          mdi-exit-run
                          </v-icon>
          
                          <v-icon
                            v-else
                            color="primary"
                          >
                          mdi-account-check
                          </v-icon>
                        </v-list-item-action>
                      </template>
                    </v-list-item>
          
                    <v-divider
                      v-if="index + 1 < appointHistory.length"
                      :key="index"
                    ></v-divider>
                  </template>
                </v-list-item-group>
              </v-list>
            </div>
              
            <!-- </v-container> -->































          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red" text @click="appoint_dialog = !appoint_dialog">Cancel</v-btn>
            <v-btn color="blue" text>Save</v-btn>
          </v-card-actions>
        </v-card>

      </v-dialog>
      <!-- appoint dialog end -->











    </template>
    <!-- <template v-slot:item.number="{ item }">
 {{tableData.map(function(x) {return x.id; }).indexOf(item.id)+1}}
</template> -->
    <template v-slot:item="{item}">
      <tr v-if="!itemVacant(item)">
        <td v-for="(dat,ind) in headers" v-if="ind <= 8">{{item[dat.value]}}</td>
        <td v-for="(dat,ind) in headers" v-if="ind > 8 && ind < 19">{{item[dat.value]}}</td>
        <td align="center">
          <v-icon small mr-5 @click="initAppoint(item)">
            mdi-clipboard-account
          </v-icon>
          <v-icon small mr-5 @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small @click="initDelete(item)">
            mdi-delete
          </v-icon>
        </td>
      </tr>

      <tr v-else="itemVacant(item)" class="vacantTr">
        <td v-for="(dat,ind) in headers" v-if="ind <= 8">{{item[dat.value]}}</td>
        <td colspan="10" align="center"><strong>(VACANT)</strong></td>
        <td align="center">
          <v-icon small mr-5 @click="initAppoint(item)">
            mdi-clipboard-account
          </v-icon>
          <v-icon small mr-5 @click="editItem(item)">
            mdi-pencil
          </v-icon>
          <v-icon small @click="initDelete(item)">
            mdi-delete
          </v-icon>
        </td>
      </tr>
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
    data() {
      return {
        date: new Date().toISOString().substr(0, 10),
        menu: false,
        modal: false,
        menu2: false,
        appoint: true,
        selected: [2],
        appointHistory: [
        {
          action: '10 yrs 5 mnths',
          title: 'ALBINA, JEFFREY C.',
          headline: 'Ali Connors',
          subtitle: 'Date vacated: July 16, 2020',
        },
        {
          action: '2 hr',
          title: 'AMOR, MARY JEAN  C.',
          headline: 'me, Scrott, Jennifer',
          subtitle: 'Date vacated: January 11, 2018',
        },
        {
          action: '6 hr',
          title: 'CABEL, RENATO B. JR.',
          headline: 'Sandra Adams',
          subtitle: 'Date vacated: September 10, 2016',
        },
        {
          action: '12 hr',
          title: 'OSTIGUE, AMORSOLO B.',
          headline: 'Trevor Hansen',
          subtitle: 'Date vacated: April 2, 2010',
        },
        {
          action: '18hr',
          title: 'SORIA , NIKKA SOLIEL T.',
          headline: 'Britta Holt',
          subtitle: 'Date vacated: October 20, 2005',
        },
      ],


        vacant: false,
        snackbar: {
          color: 'success',
          mode: '',
          snackbar: false,
          text: '',
          timeout: 1000,
          x: 'right',
          y: 'bottom',
        },
        appoint_dialog: false,
        itemForAppointment: [],
        delete_dialog: false,
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        dialog: false,
        search: '',
        headers: [
          // {
          //   text: 'No.',
          //   align: 'start',
          //   sortable: false,
          //   value: 'number',
          //   width: 1
          // },
          { text: 'ITEM NO', value: 'item_no', width: 100, align: "center", sortable: false },
          { text: 'POSITION TITLE', value: 'position_title', width: 200, align: "center", sortable: false },
          // { text: 'FUNCTION',value: 'functional_title', ,align: "center",sortable: false},
          // { text: 'OFFICE',value: 'department' ,align: "center",sortable: false},
          { text: 'SG', value: 'salary_grade', width: 10, align: "center", sortable: false },
          { text: 'AUTH SALARY', value: 'authorized_salary', align: "center", sortable: false },
          { text: 'ACTUAL SALARY', value: 'actual_salary', align: "center", sortable: false },
          { text: 'STEP', value: 'step', align: "center", sortable: false },
          { text: 'CODE', value: 'region_code', align: "center", width: 30, sortable: false },
          { text: 'TYPE', value: 'area_type', align: "center", sortable: false },
          { text: 'LVL', value: 'level', width: 1, align: "center", sortable: false },
          { text: 'LAST NAME', value: 'last_name', align: "center", sortable: false },
          { text: 'FIRST NAME', value: 'first_name', align: "center", sortable: false },
          { text: 'M.I.', value: 'middle_name', align: "center", sortable: false },
          { text: 'SEX', value: '', align: "center", sortable: false },
          { text: 'DATE OF BIRTH', value: '', align: "center", sortable: false },
          { text: 'TIN', value: '', align: "center", sortable: false },
          { text: 'DATE OF ORIGINAL APPOINTMENT', value: '', align: "center", sortable: false },
          { text: 'DATE OF LAST PROMOTION', value: '', align: "center", sortable: false },
          { text: 'STATUS', value: '', align: "center", sortable: false },
          { text: 'CIVIL SERVICE ELGIBILITY', value: '', align: "center", sortable: false },
          // { text: 'CATEGORY',value: 'category' ,align: "center"},
          // { text: 'CLASS',value: 'classification',width:1 ,align: "center"},
          { text: 'ACTIONS', value: 'actions', width: 100, sortable: false, align: "center" },
        ],
        tableData: [],
        editedIndex: -1,
        editedItem: {
          plantilla_id: 0,
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
          plantilla_id: null,
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
        departments: [],
        itemToDelete: [],
        employees: []
      }
    },

    computed: {


      formTitle() {
        return this.editedIndex === -1 ? 'New Plantilla' : 'Edit Plantilla'
      },
    },

    watch: {
      dialog(val) {
        val || this.close()
      },
      delete_dialog(val) {
        if (!val) {
          this.itemToDelete = []
        }
      },
      appoint_dialog(val) {
        if (!val) {
          this.itemForAppointment = []
        }
      }
    },

    created() {
      this.fetchData()
      axios.get('departments-list')
        .then(data => {
          this.departments = data.data.data
        })

      axios.get('employees-list')
        .then(data => {
          this.employees = data.data.data
        })

    },

    methods: {

      itemVacant(item) {
        var vacant = true
        if (item.last_name) {
          vacant = false
        }
        return vacant
      },

      fetchData() {
        axios.get('plantilla_permanents/data-table')
          .then(data => {
            this.tableData = data.data.data
          })
      },

      editItem(item) {
        this.editedIndex = this.tableData.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },



      initAppoint(item) {
        this.appoint_dialog = true
        this.itemForAppointment = item
      },

      initDelete(item) {
        this.delete_dialog = true
        this.itemToDelete = item
        // console.log('initDelete: ',this.itemToDelete);
      },

      execDelete() {
        const index = this.tableData.indexOf(this.itemToDelete)
        axios.delete('plantilla_permanents', {
          data: this.itemToDelete,
        }).then(data => {
          this.tableData.splice(index, 1)
          this.delete_dialog = false
          this.toast('Deleted successfully!')
        })


      },

      toast(msg) {
        this.snackbar.snackbar = true
        this.snackbar.text = msg
      },

      close() {
        this.dialog = false
        setTimeout(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        }, 300)
      },

      save() {
        if (this.editedIndex > -1) {
          // Edit Existing
          axios.post('plantilla_permanents', {
            data: this.editedItem,
          })
            .then(data => {

              if (typeof data.data.error == 'undefined') {
                console.log('new no error')
                Object.assign(this.tableData[this.editedIndex], this.editedItem)
                this.close()
                this.toast('Updated successfully!')
              } else {
                console.log('new with error')
                console.log(data.data.error)
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
                  this.editedItem.plantilla_id = data.data.id
                  this.tableData.push(this.editedItem)
                  console.log('new no error', this.editedItem)
                  this.close()
                  this.toast('Added successfully!')
                } else {
                  console.log('new with error')
                  console.log(data.data.error)
                }

              }

            );
        }
      },
    },
  }
</script>

<style type="text/css">
  .masterTable {
    width: 100% !important;
  }

  table .v-data-table-header tr th {
    font-size: 9px !important;
    font-weight: bold !important;
    text-align: center;
    border: 1px solid lightgrey;
    /*bottom-border: 2px solid grey;*/
    background-color: #f0f0f0;
  }

  .masterTable table tbody tr td {
    font-size: 11px !important;
    border: 1px solid lightgrey;
    /*font-weight: bold !important;*/
  }
  .vacantTr {
    background-color: #efffdc;
  }

  .vacantTr:hover {
    background-color: #efffdc;
  }

  .appointmentTable {
    width: 100% !important;
  }
  .appointmentTable th, td{
    padding-left: 10px;
  }

  .twoLineList {
    max-height: 300px;
    overflow-y: scroll;
  }
</style>