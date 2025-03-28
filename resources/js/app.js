/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//import Auth from './Auth'

/* Vue.prototype.$auth = new Auth(window.user);
console.log( window.user); */
/**
 * Sweet Alert
 */
import Swal from 'sweetalert2';
window.Swal = Swal;

/**
 * Vue Router
 */
import router from './routes'

/**
 * Vue Select para los droplist
 */

import Vue from 'vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', vSelect)




/* Vue.prototype.$auth = new Auth(window.user);
console.log( window.user); */
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('App', require('./components/App.vue').default);
Vue.component('Auth', require('./components/Auth.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Mapa from './components/Unidades/MapaCeo.vue';

const app = new Vue({
    el: '#app',
    router,
    components: { Mapa }
});
