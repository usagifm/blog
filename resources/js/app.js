

require('./bootstrap');


import swal from 'sweetalert2'
window.swal = swal;

window.Vue = require('vue');

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

import VueRouter from 'vue-router';
import routes from './routes'

Vue.use(VueRouter);

const app = new Vue({
  el: '#app',
  router: new VueRouter(routes)
});
