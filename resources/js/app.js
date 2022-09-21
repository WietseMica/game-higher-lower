import {createApp} from 'vue';
import * as VueRouter from 'vue-router';
import Toaster from '@meforma/vue-toaster';

import '../sass/app.scss'
import * as bootstrap from 'bootstrap'

import home from './routes/home';
import axios from "axios";

const routes = [
    ...home,
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory('/'),
    routes
})

const app = createApp({});
app.use(router);
app.use(Toaster);
app.mount('#app');
