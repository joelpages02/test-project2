<template>

    <Head title="Categorias" />
    <div>
        <Navbar />
        <h1 class="text-2xl font-bold mb-4">Anuncis</h1>
        <select v-model="filters.category"
            @change="filtrarPorCategoria"
            class="w-full px-4 py-2 md:px-2 md:py-1 border rounded-lg text-base md:text-md" aria-label="buscador">
            <option value="">Totes las categories</option>
            <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
        </select>

        <div class="m-4">
            <label for="buscar-anunci" class="sr-only">Buscar Anunci</label>
            <input 
                id="buscar-anunci"
                type="text" 
                v-model="searchTerm" 
                @input="buscarAnuncis" 
                placeholder="Buscar Anunci..." 
                class="w-full border rounded p-2"
                aria-label="Buscar Anunci"
            />
            <!-- Indicador de búsqueda activa -->
            <div v-if="isSearching" class="text-center py-2 text-gray-700">
                Buscando...
            </div>
        </div>

        <div class="flex justify-between items-center mb-6">
            <Link :href="route('anuncis.create')" class="text-black font-bold py-2 px-4 rounded transition-colors">
            Crear Anuncis
            </Link>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Titol</th>
                        <th class="px-4 py-2 text-left">Accions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-black">
                    <tr v-for="anunci in anuncis" :key="anunci.id">
                    <!--<tr v-for="anunci in filteredAnuncis" :key="anunci.id"></tr>-->
                        <td class="px-4 py-3">
                            <a :href="route('anuncis.show', anunci.id)">
                                {{ anunci.title }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-4">
                                <Link :href="route('anuncis.show', anunci.id)" class="hover:text-blue-700">
                                Ver
                                </Link>
                                <Link :href="route('anuncis.edit', anunci.id)" class="hover:text-green-700">
                                Editar
                                </Link>
                                <button @click="deleteAnunci(anunci.id)" class="hover:text-red-700">
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="filteredAnuncis.length === 0" class="mt-4 text-center text-gray-500">
            No se encontraron resultados para "{{ filters.search }}"
        </div>
    </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps, ref, computed, onMounted } from 'vue';
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';

const categories = computed(() => [...new Set(props.anuncis.map(e => e.category?.name).filter(Boolean))]);

const props = defineProps({
    anuncis: Array,
    category: Array,
});

const filters = ref({
    search: '',
    category: '',
    title: ''
});

const filteredAnuncis = computed(() => {
    return props.anuncis.filter(anunci => {
        if (filters.value.title && anunci.title !== filters.value.title) return false;
        if (filters.value.category && anunci.category?.name !== filters.value.category) return false;
        if (filters.value.date && anunci.date !== filters.value.date) return false;

        return true;
    });
});


/*function deleteAnunci(id) {
    router.delete(route('anuncis.destroy', id));
}*/

function deleteAnunci(id) {
   axios.post(`/anuncis/${id}`, {
     _method: 'DELETE'
   }).then(() => {
     anuncis.value = anuncis.value.filter(anunci => anunci.id !== id);
   });
 }

const anuncis = ref(props.anuncis);

const searchTerm = ref('');

const isSearching = ref(false);


let searchTimer;

function buscarAnuncis() {

    clearTimeout(searchTimer);
    
    searchTimer = setTimeout(() => {
        if (!searchTerm.value) {
            anuncis.value = props.anuncis;
            return;
        }
        
        isSearching.value = true;
        
        axios.get('/search-anuncis', {
            params: {
                search: searchTerm.value
            }
        })
        .then(response => {
            anuncis.value = response.data;
            isSearching.value = false;
        })
        .catch(error => {
            console.error('Error al buscar:', error);
            isSearching.value = false;
            
            anuncis.value = props.anuncis.filter(anunci => 
            anunci.category.name.toLowerCase().includes(searchTerm.value.toLowerCase())
            );
        });
    }, 300);
}

function filtrarPorCategoria() {
    if (!filters.value.category) {
        anuncis.value = props.anuncis;
        return;
    }

    axios.get('/filter-anuncis', {
        params: {
            category: filters.value.category
        }
    })
    .then(response => {
        anuncis.value = response.data;
    })
    .catch(error => {
        console.error('Error al filtrar por categoría:', error);
        // No hacemos filtrado local, simplemente mostramos un mensaje de error
        alert('Error al filtrar las categorías. Por favor, inténtelo de nuevo.');
    });
}

</script>

<style scoped></style>