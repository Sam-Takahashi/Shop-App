require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Icons from './Components/Icons';

// (window.Toast)allow Vue to recognize it from the front end
// bring in from views/app.blade.php to resources/app.js and giving it the Toast designation(Toast can now be called from anywhere in the app!(window.))
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
    }
});


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        // Vue3 Removed Filters https://www.youtube.com/watch?v=3MHXN4wVUBE&list=PLW-lITXBwAP8zqZTps7RYDlDHgXDw6RwR&index=6
        const VueApp = createApp({ render: () => h(app, props) });
        VueApp.config.globalProperties.$filters = {
            formatCurrency(value) {
                value = (value / 1);
                return value.toLocaleString('ja-JP', { //The toLocaleString() method returns a string with a language-sensitive representation of this number.
                    style: 'currency',
                    currency: 'JPY'
                });
            }
        };
        // title: (title) => `${title} - ${appName}`,
        // resolve: (name) => require(`./Pages/${name}.vue`),
        // setup({ el, app, props, plugin }) {
        //     const VueApp = createApp({ render: () => h(app, props) });
        //     VueApp.config.globalProperties.$filters = {
        //         formatCurrency(value) {
        //             value = (value / 100);
        //             return value.toLocaleString('en-US', {
        //                 style: 'currency',
        //                 currency: 'USD'
        //             });
        //         }
        //     };

        VueApp.use(plugin)
            .mixin({ methods: { route } })
            .component('icon', Icons) // global
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
