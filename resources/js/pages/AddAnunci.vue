<template>
    <div class="max-w-md mx-auto mt-10">
        <Navbar />
        <h1 class="text-2xl font-bold mb-4">Añadir Evento</h1>
        <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Títol de l'Anunci
                </label>
                <input type="text" id="title" v-model="form.title"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Descripció de l'Anunci
                </label>
                <input type="text" id="description" v-model="form.description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Data de l'Anunci
                </label>
                <input type="date" id="date" v-model="form.date"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="hour">
                    Hora de l'Anunci
                </label>
                <input type="time" id="hour" v-model="form.hour"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email de l'Anunci
                </label>
                <input type="text" id="email" v-model="form.email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    required />
            </div>
            <label for="category">
                Categoria
            </label>
            <select id="category" v-model="form.category_id" title="categoria" required>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}
                </option>
            </select>
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Afegir Anunci
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';

const props = defineProps({
  categories: Array,
})

const form = useForm({
    title: '',
    description: '',
    date: '',
    hour: '',
    email: '',
    category_id: '',
})

function submit() {
    form.post(route("anuncis.store"));
}
</script>