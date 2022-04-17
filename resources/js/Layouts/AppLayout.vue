<script>
// Auto extension can make the code buggy. Varifiy!
import { defineComponent } from 'vue';
import { Head } from '@inertiajs/inertia-vue3';
import Nav from '@/Components/Nav';
import Footer from '@/Components/Footer';

export default defineComponent({
    props: {
        title: String,
    },

    components: {
        Head,
        Nav,
        Footer,
        
    }
})
</script>

<template>
    <div>
        <Head :title="title" />
        <div class="min-h-screen bg-gray-100">

            <Nav />

            <!-- Page Heading -->
            <header class="bg-gray-700 shadow">
                <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
                    <h2 class="text-white text-center leading-tight">
                        Lorem ipsum dolor sit amet.
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
           <Footer />
        </div>
    </div>
</template>
