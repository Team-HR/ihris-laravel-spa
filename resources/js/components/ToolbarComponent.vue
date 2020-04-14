<template>

</template>
<script>

  const qs = require('qs');
  export default {
    props: {
        fetchUrl: { type: String, required: true },
    },
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
      this.fetchData(this.fetchUrl)
      axios.get('departments-list')
            .then(data => {
              this.departments = data.data.data
              console.log(this.departments);
            })
    },

    methods: {
      fetchData(url) {
          axios.get(url)
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

        this.close()
      },
    },
  }
</script>