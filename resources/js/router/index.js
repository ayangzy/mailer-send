import { createRouter,  createWebHistory } from 'vue-router';

import SendEmail from '../components/SendEmail.vue';
import ListEmails from '../components/ListEmails.vue';
import ListRecipients from '../components/ListRecipients.vue';
import ViewEmail from '../components/ViewEmail.vue';
import NotFound from '../components/NotFound.vue';


const routes = [
    {
        path: '/',
        component: SendEmail
    },

    {
        path: '/list-emails',
        component: ListEmails
    },

    {
        path: '/list-recipients',
        component: ListRecipients,
    },

    {
        path: '/view-email',
        component: ViewEmail
    },

    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    },
]
const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;