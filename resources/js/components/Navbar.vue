<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const isOpen = ref(false);

const toggleMenu = () => {
    isOpen.value = !isOpen.value;
};
</script>

<template>
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <Link href="/" class="text-white font-bold text-xl">
                            <img src="/logo.png" alt="logo" class="w-15">
                        </Link>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <Link
                                href="/anuncis"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Anuncis
                            </Link>
                            <Link
                                href="/login"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Login
                            </Link>
                            <Link
                                href="/register"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Register
                            </Link>
                            <!--<Link
                                href="/categories"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Categorías
                            </Link>-->
                        </div>
                    </div>
                </div>

                <!-- Botón hamburguesa -->
                <div class="md:hidden">
                    <button @click="toggleMenu" 
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none"
                            aria-label="menumbl">
                        <svg class="h-6 w-6" 
                             :class="{'hidden': isOpen, 'block': !isOpen }"
                             stroke="currentColor" 
                             fill="none" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg class="h-6 w-6" 
                             :class="{'block': isOpen, 'hidden': !isOpen }"
                             stroke="currentColor" 
                             fill="none" 
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" 
                                  stroke-linejoin="round" 
                                  stroke-width="2" 
                                  d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menú móvil -->
        <div class="md:hidden"
             :class="{'block': isOpen, 'hidden': !isOpen}"
             @click="isOpen = false">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Link
                    href="/anuncis"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Anuncis
                </Link>
                <Link
                    href="/login"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Login
                </Link>
                <Link
                    href="/register"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Register
                </Link>
            </div>
        </div>
    </nav>
</template>

<style scoped>
/* Transiciones para el menú móvil */
.md\:hidden {
    transition: all 0.3s ease-in-out;
}
</style> 