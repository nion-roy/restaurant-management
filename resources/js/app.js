import { createApp } from 'vue';
import Login from './components/Login.vue';
import Toast, { POSITION } from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const app = createApp(Login);

app.use(Toast, {
  position: POSITION.BOTTOM_CENTER,
  timeout: 3000,
});

app.mount('#app');
