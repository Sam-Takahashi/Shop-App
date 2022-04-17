<template>
    <Link :href="href" :class="classes" v-if="as === 'href'">
        <slot></slot>
    </Link>

    <button :class="classes" v-else>
        <slot></slot>   
    </button>
</template>

<script>
import { defineComponent } from "@vue/runtime-core";
import {Link} from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            Link,
        },
        // will use as links or as btns. if this link is says 'v-if' if we have an 'as' set in that link within our other components that we're using this, if we have it set to href, thats whats going to display(as a link), if not it will display as a btn(with the same classes(defined in computed below))
        props: ['active', 'href', 'as'], 
        computed: {
            classes() {
                return 'justify-center inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 transition'
            }
        }
    })
</script>