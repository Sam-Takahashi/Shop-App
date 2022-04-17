<template>
    <app-layout :title="product.name">
        <secondary-header>
            <!-- breadcrumb -->
            <template #breadcrumbs>
                <icon name="angle-right" class="w-4 h-4 fill-current"></icon>
                <Link :href="route('shop.index')" class="text-grey-700 transition hover:text-yellow-500">Shop</Link>
                <icon name="angle-right" class="w-4 h-4 fill-current"></icon>
                <span>Shop {{ product.name }}</span>
            </template>
            <!-- Search bar -->
            <template #search>
                SEARCH
            </template>
        </secondary-header>

        <!-- Single Product Page Layout -->
        <div class="max-w-7xl mx-auto px-4 py-4 sm:flex sm:space-x-4 sm:px-6 lg:px-8">
            <div class="flex-1 sm:border-r">
                <div class="border-2 p-2">
                    <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="w-full object-cover">
                </div>
                <div class="flex space-x-4 mt-4">
                    <button type="button">
                        <icon name="angle-left" class="w-4 h-4 fill-current"></icon>
                    </button>
                    <div class="w-1/4">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="object-cover">
                    </div>
                    <div class="w-1/4">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="object-cover">
                    </div>
                    <div class="w-1/4">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="object-cover">
                    </div>
                    <div class="w-1/4">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="object-cover">
                    </div>
                    <button type="button">
                        <icon name="angle-right" class="w-4 h-4 fill-current"></icon>
                    </button>
                </div>
            </div>
            <div class="flex-1 space-y-6 my-4 sm:mt-0 sm:border-l sm:pl-4">
                <form @submit.prevent="submit">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-semibold capitalize italic">{{ product.name }}</h2>
                        <div class="text-xl capitalize italic">
                            <span>
                                Price:
                            </span>
                            <span>
                                {{ $filters.formatCurrency(product.price) }}
                            </span>
                        </div>
                    </div>

                    <div class="flex space-x-4 mt-4">
                        <p class="text-xl capitalize">
                            {{ product.details }}
                        </p>
                    </div>
                    <div class="flex space-x-4 mt-4">
                        <span class="text-xl capitalize">
                            Sku:
                        </span>
                        <p class="text-xl capitalize">
                            {{ product.product_code }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <!-- SOLD OUT -->
                        <template v-if="product.quantity <= 0">
                            <div class="mt-4">
                                <span class="text-2x1 text-red-600 font-semibold italic uppercase">
                                   Sold Out
                                </span>
                            </div>
                        </template>
                        <!-- LOW STOCK -->
                        <template v-else-if="product.quantity <= 5">
                            <div class="mt-4">
                                <span class="text-2x1 text-red-600 font-semibold italic uppercase">
                                   Only {{ product.quantity }} left!
                                </span>
                                <div class="flex items-center">
                                <label for="quantity" class="flex-1 text-xl capitalize">Qty:</label>
                                    <select class="flex-1 w-full border bg-white rounded px-3 py-1 outline-none" tabindex="1" v-model="form.quantity">
                                        <!-- https://www.youtube.com/watch?v=4R7lMrdlqRk&list=PLW-lITXBwAP8zqZTps7RYDlDHgXDw6RwR&index=7 -->
                                        <option :value="qty" :selected="qty === quantity" v-for="(qty, index) in product.quantity" :key="index">{{ qty }}</option>
                                    </select>
                                </div>
                            </div>
                        </template>
                        <!-- STOCK IS NORMAL -->
                        <template v-else>
                            <div class="flex items-center">
                                <label for="quantity" class="flex-1 text-xl capitalize">Qty:</label>
                                <select class="flex-1 w-full border bg-white rounded px-3 py-1 outline-none" tabindex="1" v-model="form.quantity">
                                    <option :value="qty" :selected="qty === quantity" v-for="(qty, index) in product.quantity" :key="index">{{ qty }}</option>
                                </select>
                            </div>
                        </template>
                    </div>
                    <div class="text-center mt-4" v-if="product.quantity > 0"><!-- display if product quantity is greater then 0 -->
                        <gray-button as="submit" class="text-sm">
                            <span>Add to Cart</span>
                        </gray-button>
                    </div>
                </form>
                <div class="flex flex-col divide-y">
                    <div>
                        <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                            <span>Product Description</span>
                        </button>
                    </div>
                    <div>
                        <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                            <span>Product Features</span>
                        </button>
                    </div>
                    <div>
                        <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                            <span>Return Policy</span>
                        </button>
                    </div>
                    <div>
                        <button type="button" class="flex justify-between items-center bg-gray-300 rounded-t px-4 py-4 w-full transition hover:text-white hover:bg-gray-700 sm:px-6 lg:px-8">
                            <span>Reviews</span>
                        </button>
                    </div>
                </div>
                <div class="text-center">
                    <p>Suggested based on your search</p>
                </div>
                <div class="flex space-x-4">
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="w-full object-cover">
                    </Link>
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="w-full object-cover">
                    </Link>
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="w-full object-cover">
                    </Link>
                    <Link href="#" class="flex border border-black w-1/4 h-24">
                        <img :src="'/storage/images/defaults/'+product.image" :alt="product.name" class="w-full object-cover">
                    </Link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import { Link } from "@inertiajs/inertia-vue3";
// [../, @/]Auto extension can make the code buggy? Varifiy!
import AppLayout from "@/Layouts/AppLayout.vue";
import GrayButton from '@/Components/Buttons/GrayButton'
import SecondaryHeader from "@/Components/SecondaryHeader";


export default defineComponent({
    props: ['product'], // show() in ShopController

    components: {
        // globally invoked components will cause an error if automatically imported(VSCode) check resources/js/app.js(invoke)
        Link,
        AppLayout,
        GrayButton,
        SecondaryHeader,

    },
    data() {
        return {
            quantity: 1, // https://www.youtube.com/watch?v=amHMnF1JaJc&list=PLW-lITXBwAP8zqZTps7RYDlDHgXDw6RwR&index=10 4:30 (quantity is 1 unless other selected)
            form: this.$inertia.form({
                id: this.product.id,
                name: this.product.name,
                price: this.product.price,
                product_code: this.product.product_code,
                details: this.product.details,
                image: this.product.image,
                slug: this.product.slug,
                quantity: 1, // this quantity is actual quantity sent with form
                totalQty: this.product.quantity, // subtract from the total quantity of the item to make sure the calc are correct in the cart when they get pushed forward to the cart page.

            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('cart.store', this.form), { //store() CaryController
                preserveScroll: true,
                onSuccess: () => {
                    // SweetAlert Plugin
                    Toast.fire({
                        icon: 'success',
                        title: `${this.form.name} has successfully been added to your cart!`
                    })
                }
            })
        }
    }
})


</script>

<style>
/* SweetAlert Custom Styles */
body.swal2-toast-shown .swal2-container.swal2-top-end,
body.swal2-toast-shown .swal2-container.swal2-top-right {
    top: 60px;
    /* right: 60px; */
}
</style>
