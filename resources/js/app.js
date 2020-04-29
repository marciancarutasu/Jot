import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import router from './router';
import App from './components/App';

Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
// Vue.use(IconsPlugin)

require('./bootstrap');

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router
});
