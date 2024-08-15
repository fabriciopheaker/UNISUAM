import './bootstrap';

import { createApp } from 'vue';
import HomeUsers from './pages/HomeUsers.vue';

const app = createApp(HomeUsers);


app.mount('#app');