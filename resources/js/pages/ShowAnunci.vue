<template>
    <div>
        <Navbar />
        <h1 class="text-2xl font-bold mb-4">Anunci {{ anuncis.name }}</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Descripció</th>
                    <th class="px-4 py-2">Data</th>
                    <th class="px-4 py-2">Hora</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Categoria</th>
                </tr>
                <tbody class="divide-y divide-black">
                <tr class="text-center">
                    <td class="px-4 py-2">
                        {{ anuncis.title }}
                    </td>
                    <td class="px-4 py-2">
                        {{ anuncis.description }}
                    </td>
                    <td class="px-4 py-2">
                        {{ anuncis.date }}
                    </td>
                    <td class="px-4 py-2">
                        {{ anuncis.hour }}
                    </td>
                    <td class="px-4 py-2">
                        {{ anuncis.email }}
                    </td>
                    <td class="px-4 py-2">
                        {{ anuncis.category.name}}
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
    import {defineProps} from 'vue';
    import Navbar from '@/components/Navbar.vue';
    const props = defineProps({
        anuncis: Array,
    });
    
</script>