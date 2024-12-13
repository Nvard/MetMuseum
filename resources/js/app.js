import './bootstrap';
import { createApp } from 'vue';  // Vue 3.x
import App from './App.vue';      // Import your App.vue component
           // Optional: Import Laravel's bootstrap (for example, for CSRF token)

// Create a Vue app and mount it to an HTML element with the ID 'app'
createApp(App).mount('#app');
