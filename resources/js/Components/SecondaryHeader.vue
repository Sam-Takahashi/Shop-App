<template>
    <header class="text-gray-700 bg-gray-300 shadow">
        <div class="flex justify-between items-center max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center leading-tight">
                <Link :href="route('welcome')" class="text-gray-700 transition hover:text-yellow-500">Home</Link>
                <!-- Breadcrumb Slot -->
                <slot name="breadcrumbs"></slot> <!--  if there is something with the title of 'breadcrumbs', it will be passed into this component eg.<template #breadcrumbs> -->

            </div>
            <div class="w-1/2">
               <!-- Search Bar Slot -->
               <slot name="search"></slot>
            </div>
        </div>
    </header>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            Link,
        }
    })
</script>