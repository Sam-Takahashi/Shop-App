<template>
       <app-layout title="Checkout">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-4 sm:px-6 md:flex md:space-y-0 md:space-x-4 lg:px-8">
            <div class="flex-1">
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
                    <form id="payment-form" @submit.prevent="processPayment">
                        <div class="-mx-3 md:flex mb-6">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                                    Name
                                </label>
                                <input type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 rounded py-2 px-4" id="name" autofocus required v-model="form.name">
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.name">
                                    {{ errors.name[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="address">
                                    Address
                                </label>
                                <input type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 rounded py-2 px-4" id="address" required v-model="form.address">
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.address">
                                    {{ errors.address[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-2">
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city">
                                    City
                                </label>
                                <input type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 rounded py-2 px-4" id="city" required v-model="form.city">
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.city">
                                    {{ errors.city[0] }}
                                </span>
                            </div>
                            <div class="md:w-1/2 px-3 mb-6">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="region">
                                   Regions/Prefectures
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-100 text-gray-700 border border-gray-400 py-2 px-4 pr-8 rounded" id="region" required :value="form.regions" v-model="form.region">
                                        <option disabled value="">Please select one</option>
                                        <option v-for="(region, index) in regions" :key="index" :selected="region === form.region">{{ region }}</option>
                                    </select>
                                </div>
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.region">
                                    {{ errors.region[0] }}
                                </span>
                            </div>
                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zip_code">
                                    Zip Code
                                </label>
                                <input type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 rounded py-2 px-4" id="zip_code" required v-model="form.zip_code">
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.zip_code">
                                    {{ errors.zip_code[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="-mx-3 md:flex mb-6">
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                                    E-mail
                                </label>
                                <input type="email" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 rounded py-2 px-4" id="email" required v-model="form.email">
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.email">
                                    {{ errors.email[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="-mx-3 mb-6">
                            <div class="px-3 mb-6 w-full">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_on_card">
                                    Name on Card
                                </label>
                                <input type="text" class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-400 rounded py-2 px-4" id="name_on_card" required v-model="form.name_on_card">
                                <span class="flex justify-center text-md text-red-600 mt-2" v-if="errors.name_on_card">
                                    {{ errors.name_on_card[0] }}
                                </span>
                            </div>
                            <div class="px-3 mb-6 w-full md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="card_element">
                                    Credit Card
                                </label>
                                <!-- stripe component -->
                                <div id="card-element"></div>
                                <p id="card-error" role="alert">{{ cardError }}</p>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <yellow-button as="submit" class="text-sm" :class="{ 'opacity-50 cursor-not-allowed': disabled }" :disabled="disabled">
                                <icon name="spinner" class="animate-spin h-5 w-5 fill-current" v-if="loading"></icon>
                                <span v-else>Pay now</span>
                            </yellow-button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="flex-1">
                <order-totals
                    :taxRate="cartTaxRate"
                    :subtotal="cartSubtotal"
                    :tax="newTax"
                    :code="code"
                    :discount="discount"
                    :newSubtotal="newSubtotal"
                    :total="newTotal"
                ></order-totals>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3'
    import { loadStripe } from '@stripe/stripe-js'
    import AppLayout from '@/Layouts/AppLayout'
    import OrderTotals from '@/Components/OrderTotals'
    import YellowButton from '@/Components/Buttons/YellowButton'
    import regions from '@/prefectures'

    export default defineComponent({
        props: [
            'cartTaxRate',
            'cartSubtotal',
            'newTax',
            'code',
            'discount',
            'newSubtotal',
            'newTotal',
        ],
        components: {
            Link,
            AppLayout,
            OrderTotals,
            YellowButton,

        },
        data() { // not using inertia for this form because we will be making Axios requests between our backend and Stripe
            return {
                cardElement: {}, // for stripe
                cardError: '', // for stripe
                elements: {}, // for stripe
                disabled: true, // enable button once form is correctly filled
                errors: [],
                form: { // when empty, default to empty string or vue will throw an error
                    name: '',
                    email: '',
                    address: '',
                    city: '',
                    region: '',
                    zip_code: '',
                    name_on_card: '',

                },
                loading: false,
                regions,
                stripe: {},
                style: {
                    base: {
                        fontFamily: "Montserrat, sans-serif",
                        fontSmoothing: "antialiased",
                        fontSize: "16px",
                    },
                    invalid: {
                        fontFamily: "Montserrat, sans-serif",
                        color: "#ff0000",
                        iconColor: "#ff0000",
                    }
                },
            }

        },
        mounted() { // lifecycle hook
            this.initStripe()
        },
        methods: {
            async initStripe() {
                this.stripe = await loadStripe(process.env.MIX_STRIPE_KEY)
                this.elements = this.stripe.elements()
                this.cardElement = this.elements.create("card", {
                    style: this.style,
                    hidePostalCode: true,

                })
                this.cardElement.mount('#card-element')
                this.cardElement.addEventListener('change', (event) => {
                    this.disabled = false // enable button
                    this.cardError = event.error ? event.error.message : ""
                })
            }
        }
    })
</script>

<style> 
/* Stripe styles(tailwind-ish) */
#card-error {
    color: #f00;
    text-align: center;
    font-size: 16px;
    line-height: 17px;
    margin-top: 12px;
}
#card-element {
    border-radius: .25rem;
    padding: 12px;
    --tw-border-opacity: 1;
    border: 1px solid rgba(156, 163, 175, var(--tw-border-opacity));
    height: 44px;
    widows: 100%;
    --tw-bg-opacity: 1;
    background-color: rgba(243, 244, 246, var(--tw-bg-opacity));
}
</style>