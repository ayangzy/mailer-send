require('./bootstrap');
import './assets/css/atlantis.css';
import './assets/css/bootstrap.min.css';
import CKEditor from 'ckeditor4-vue'


import {createApp} from 'vue'

import App from './App.vue'

import router from './router'



createApp(App).use(router).mount("#app")


