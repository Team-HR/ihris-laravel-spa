<template>
  <div class="data-table">
    <table class="table table-sm table-bordered">
      <thead>
      <tr style="text-align: center; vertical-align: middle;">
        <th class="table-head">#</th>
        <th v-for="column in columns" :key="column"
            class="table-head">
          {{ column | columnHead }}
        </th>
      </tr>
      </thead>
      <tbody>
          <tr class="" v-if="tableData.length === 0">
            <td class="lead text-center" :colspan="columns.length + 1">No data found.</td>
          </tr>
          <tr v-for="(data, key1) in tableData" :key="data.id" :id="data.id" class="m-datatable__row" v-else>
                <td>{{ serialNumber(key1) }}</td>
                <td v-for="(only, key) in onlys">{{ (data[only]?data[only]:'---') }}</td>
                <td>
                    <a href="javascript:void(0)" @click="{{edit(data)}}">Edit</a>
                </td>
            </td>
          </tr>
      </tbody>
    </table>
<!-- start edit modal -->
<div id="modal_edit" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title">MODIFY PLANTILLA</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
<!-- start form -->
<form id="form_edit" @submit.prevent="submitEdit()">
    <input type="hidden" name="id" id="id">
    <div class="form-row">
        <div class="form-group col-4">
            <label for="item_no" class="col-form-label-sm">ITEM NO:</label>
            <input type="text" class="form-control form-control-sm" name="item_no" id="item_no" aria-describedby="itemNumHelp" placeholder="Item number ...">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="position_title" class="col-form-label-sm">POSITION TITLE:</label>
            <input type="text" class="form-control form-control-sm" name="position_title" id="position_title" placeholder="Position title ...">
        </div>
        <div class="form-group col-6">
            <label for="functional_title" class="col-form-label-sm">FUNCTIONAL TITLE:</label>
            <input type="text" class="form-control form-control-sm" name="functional_title" id="functional_title" placeholder="Functional title ...">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-6">
            <label for="department_id" class="col-form-label-sm">DEPARTMENT:</label>
            <select class="form-control form-control-sm" name="department_id" id="department_id">
                <option selected>Select Department</option>
                <option v-for="department in departments" :value="department.id">{{department.name}}</option>
            </select>
        </div>
        <div class="form-group col-3">
            <label for="level" class="col-form-label-sm">LEVEL:</label>
            <input type="text" class="form-control form-control-sm" name="level" id="level" placeholder="Level ...">
        </div>
        <div class="form-group col-3">
            <label for="salary_grade" class="col-form-label-sm">SALARY GRADE:</label>
            <input type="text" class="form-control form-control-sm" name="salary_grade" id="salary_grade" placeholder="Salary grade...">
        </div>
    </div>
</form>
<!-- end form -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button form="form_edit" type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

  </div>
</template>

<script>
export default {
  props: {
    fetchUrl: { type: String, required: true },
    columns: { type: Array, required: true },
  },
  data() {
    return {
        departments:[],
      tableData: [],
      onlys: [
        'item_no',
        'position_title',
        'functional_title',
        'department_short',
        'level',
        'salary_grade',
        'authorized_salary',
        'actual_salary',
        'step',
        'region_code',
        'area_type',
        'category',
        'classification',
      ]
    }
  },
  created() {
     this.fetchData(this.fetchUrl)
     axios.get('departments-list').then(data => {
        this.departments = data.data.data
    })

  },
  methods: {
    fetchData(url) {
      axios.get(url)
        .then(data => {
          this.tableData = data.data.data
          this.edit(this.tableData[0]);
          // console.log(this.tableData)
        })
    },
    serialNumber(key) {
      return key + 1;
    },
    edit(data){
        //modal
        $('#modal_edit').modal('show');
        //inputs
        $('#id').val(data.id);
        $('#item_no').val(data.item_no);
        $('#position_title').val(data.position_title);
        $('#functional_title').val(data.functional_title);
        $('#department_id').val(data.department_id);
        $('#level').val(data.level);
        $('#salary_grade').val(data.salary_grade);
    },
    submitEdit (){
        console.log($("#form_edit").serialize());
    }

  },
  filters: {
    columnHead(value) {
      return value.split('_').join(' ').toUpperCase()
    }
  },
  name: 'DataTable'
}
</script>

<style scoped>
td {
    padding: 0px;
}
</style>