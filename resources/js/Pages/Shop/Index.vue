<template>
    <app-layout :title="`Shop ${ categoryName }`">
        <!-- breadcrumb extension -->
        <secondary-header>
            <template #breadcrumbs>
                <icon name="angle-right" class="w-4 h-4 fill-current"></icon>
                <span>Shop {{ categoryName }}</span>
            </template>
             <!-- Search bar -->
            <template #search>
                SEARCH
            </template>
        </secondary-header>

        <div class="flex">
            <!-- sidebar -->
            <div class="border-r">
                <div>
                    <div class="text-white text-center bg-gray-700 py-4">
                        <p>Shop By Category</p>
                    </div>
                    <div class="flex flex-col divide-y">
                        <!-- pass in params(category) defined by (category.slug) eg. {category: category.slug} -->
                        <!-- https://www.youtube.com/watch?v=glohe7j6IH0 14:30 -->
                        <!-- binding class(:class)if when on current route, add class(tailwind styles(eg. .is-current))else be empty.  [read ziggy docs] -->
                        <Link :href="route('shop.index', {category: category.slug})" class="text-left px-4 py-4 transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8" :class="route().current('shop.index', {category: category.slug}) ? 'bg-gray-700 text-white' : ''" v-for="(category, index) in categories" :key="index">
                        {{category.name}}
                        </Link>
                    </div>
                </div>
            </div>
            <!-- sidebar end -->
            <!-- products -->
            <div class="border-l w-4/5">
            <div class="flex justify-end space-x-2 pt-4 pr-4">
            <!-- <div class="flex justify-end space-x-2 pt-4 pr-4" v-if="categorySlug"> removing v-if fixed display problem? -->
                <span class="font-bold">Price:</span>
                <Link :href="route('shop.index', {category: categorySlug, sort: 'low_high'})" class="hover:text-yellow-500">Low to High</Link>
                <span>|</span>
                <Link :href="route('shop.index', {category: categorySlug, sort: 'high_low'})" class="hover:text-yellow-500">High to Low</Link>
            </div>
                <div class="container flex flex-wrap mx-auto">
                    <!-- If No Product -->
                    <div class="flex justify-center my-4 w-full" v-if="products.length === 0">
                        <img src="/storage/images/defaults/no_image.jpg" alt="No Image">
                    </div>
                    <Link :href="route('shop.show', product.slug)" class="flex flex-col w-full p-4 rounded sm:w-1/2 md:w-1/3" v-for="(product, index) in products" :key="index">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="h-72 object-cover md:w-72 lg:w-96">
                        <div class="flex justify-around bg-gray-700 py-2">
                            <span class="text-yellow-500">{{ $filters.formatCurrency(product.price) }}</span><!-- formatCurrency defined in resources/js/app.js -->
                            <span class="text-white">{{ product.name }}</span>
                        </div>
                    </Link>
                </div>
            </div>
            <!-- products end -->
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
// [../, @/]Auto extension can make the code buggy. Varifiy!
import AppLayout from "@/Layouts/AppLayout.vue";
import SecondaryHeader from "@/Components/SecondaryHeader";


export default defineComponent({
    props: ['products', 'categories', 'categoryName', 'categorySlug'], // index() in ShopController

    components: {
        // globally invoked components will cause an error if automatically imported(VSCode) check resources/js/app.js(invoke)
        Link,
        AppLayout,
        SecondaryHeader,

    }
})


</script>
