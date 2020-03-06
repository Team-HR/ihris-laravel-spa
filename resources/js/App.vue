<template>
  <div id="app">
    <div class="heading">
      <h1>Plantilla</h1>
    </div>
    <PlantillaPermanentComponent
      v-for="plantilla in plantillas"
      v-bind="plantilla"
      :key="plantilla.id"
      @update="update"
      @delete="del"
    ></PlantillaPermanentComponent>
    <div>
      <button @click="create">Add</button>
    </div>
  </div>
</template>
<script>
  function PlantillaPermanent({ id, status, position_title}) {
    this.id = id;
    this.status = status;
    this.position_title = position_title;
  }

import PlantillaPermanentComponent from './components/PlantillaPermanentComponent.vue';

  export default {
    data() {
      return {
        plantillas: []
      }
    },

    methods: {
      async create() {
        // To do
      },
      async read() {
        // To do
        const { data } = window.axios.get('/api/plantilla_permanent');
        // console.log(data)
        // const { data } = window.axios.get('/api/cruds');
        data.forEach(plantilla => this.plantillas.push(new PlantillaPermanent(plantilla)));
      },
      async update(id, status) {
        // To do
      },
      async del(id) {
        // To do
      }
    },
    created() {
      this.read();
    },
    components: {
      PlantillaPermanentComponent
    }
  }
</script>