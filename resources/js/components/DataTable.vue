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
        <h5 class="modal-title">Modify Plantilla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <p>Modal body text goes here.</p> -->
<form id="form_edit" @submit.prevent="submitEdit()">
  <div class="form-group">
    <label for="item_no">Item No:</label>
    <input type="text" class="form-control" name="item_no" id="item_no" aria-describedby="itemNumHelp">
    <small id="itemNumHelp" class="form-text text-muted">Item number is unique.</small>
  </div>
  <div class="form-group">
    <label for="position_title">Position Title</label>
    <input type="text" class="form-control" name="position_title" id="position_title">
  </div>
</form>

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
    return this.fetchData(this.fetchUrl)
    // console.log (this.fetchUrl);
  },
  methods: {
    fetchData(url) {
      axios.get(url)
        .then(data => {
          this.tableData = data.data.data
          console.log(data);
        })
    },
    /**
     * Get the serial number.
     * @param key
     * */
    serialNumber(key) {
      return key + 1;
    },
    edit(data){
        $('#modal_edit').modal('show');
        // $('#item_no').val(arr.item_no);
        // $('#position_title').val(arr.position_title);
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
</style>