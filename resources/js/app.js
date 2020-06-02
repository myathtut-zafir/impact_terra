require('./bootstrap');

window.Vue = require('vue');

import VueAxios from 'vue-axios';
import axios from 'axios';
import Toastr from 'vue-toastr';



Vue.use(Toastr);
Vue.use(VueAxios, axios);

const app = new Vue({
}).$mount('#app');
