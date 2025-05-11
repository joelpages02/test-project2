<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Navbar from '@/components/Navbar.vue';
import Cookies from '@/components/Cookies.vue';
</script>

<template>
    <Navbar />

    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div>
        <header>
            <h1 class="m-4">Joel Pagès Casellas</h1> <br>
        </header>
        <div>
        <h1 class="m-4 text-xl">Benvinguts a la pàgina web per saber tots el anuncis desde el teu mbl</h1>
        <h1 class="m-4 text-xl">Aquest lloc web te la funcionalitat de tenir el dia els nous anuncis que van sortint. Així mai et perds res!</h1> <br>
        <h1 class="m-4 text-sm">No feu cas a cap falta orografica (si aqui tmb n'hi han :)</h1>

    </div>
    </div>
    <Cookies />
</template>
