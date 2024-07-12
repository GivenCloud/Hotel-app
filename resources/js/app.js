import { createApp } from 'vue';
import './bootstrap';
import Alpine from 'alpinejs';
import App from './App.vue';
import '../css/app.css';

window.Alpine = Alpine;
Alpine.start();
createApp(App).mount('#app');