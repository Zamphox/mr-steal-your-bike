/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import {library} from "@fortawesome/fontawesome-svg-core";
import {faBiking, faExclamationTriangle} from "@fortawesome/free-solid-svg-icons";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";

library.add([faBiking, faExclamationTriangle]);

window.Vue = require('vue');

import App from './components/App';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import vuetify from "./plugins/vuetify/index";
import Notifications from "vue-notification";
import VModal from 'vue-js-modal'

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(Notifications);
Vue.use(VModal);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('v-modal', VModal);

import {routes} from './routes';
import './helpers'
import './plugins/validation';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    vuetify,
    el: '#app',
    router: router,
    render: h => h(App)
});
