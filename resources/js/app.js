import './bootstrap';
import { createApp } from 'vue';
import router from './router.js';
import app from './layouts/app.vue';
import 'vue-toast-notification/dist/theme-sugar.css'; // Import the CSS theme
import VueToast from 'vue-toast-notification';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const App = createApp(app);
App.use(router);
App.use(VueToast);
App.use(VueSweetalert2);
App.mount("#app")
