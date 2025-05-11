<template>
    <div class="sm:max-w-md sm:mx-auto sm:mt-10">
      <Navbar />
      <h1 class="text-2xl font-bold mb-6">Editar Anunci</h1>
      <form @submit.prevent="submit" class="bg-white shadow-md rounded px-4 sm:px-8 py-6 mb-4">
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
            Nom de l'Anunci
          </label>
          <input type="text" 
                 id="title" 
                 v-model="form.title"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
  
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
            Descripció de l'Anunci
          </label>
          <input type="text" 
                 id="description" 
                 v-model="form.description"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
            Data de l'Anunci
          </label>
          <input type="date" 
                 id="date" 
                 v-model="form.date"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="hour">
            Hora de l'Anunci
          </label>
          <input type="time" 
                 id="hour" 
                 v-model="form.hour"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email de l'Anunci
          </label>
          <input type="text" 
                 id="email" 
                 v-model="form.email"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
            Categoria
          </label>
          <select id="category" 
                  v-model="form.category_id" 
                  title="categoria"
                  required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <option value="" disabled selected>Selecciona una categoría</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
        </div>
  
        <div class="flex items-center justify-end">
          <button type="submit"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition-colors">
            Actualitzar Anunci
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import Navbar from '@/components/Navbar.vue';
  import { useForm } from '@inertiajs/vue3';
  import { onMounted, ref } from 'vue';
  
  const previewImage = ref(null);
  
  const props = defineProps({
    anunci: Object,
    categories: Array,
  });
  
  const form = useForm({
    title: '',
    description: '',
    date: '',
    hour: '',
    email: '',
    category_id: '',
    _method: 'put',
  });
  
  onMounted(() => {
    if (props.anunci) {
      form.title = props.anunci.title;
      form.description = props.anunci.description;
      form.date = props.anunci.date;
      form.hour = props.anunci.hour;
      form.email = props.anunci.email;
      form.category_id = props.anunci.category_id;
    }
  });
  
  function submit() {
    form.post(route('anuncis.update', { anunci: props.anunci.id }), {
      forceFormData: true
    });
  }
  </script>
  
  <style scoped>
  /* Estilos opcionales para tu vista */
  </style>