// Vite bilan yuklanadigan CSS fayllarini qo‘shish
import '../css/app.css';

// Laravelning asosiy konfiguratsiya fayli (agar mavjud bo‘lsa)
import './bootstrap';

// Konsolga tekshirish uchun xabar chiqarish
console.log('Vite muvaffaqiyatli yuklandi!');

// Agar siz Alpine.js ishlatayotgan bo‘lsangiz
import Alpine from 'alpinejs';

// Alpine-ni boshlash
window.Alpine = Alpine;
Alpine.start();




// Agar Vue.js ishlatayotgan bo‘lsangiz (o‘chirib qo‘ying agar kerak bo‘lmasa)
/*
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({});
app.component('example-component', ExampleComponent);
app.mount('#app');
*/

// Agar siz jQuery yoki boshqa kutubxonalarni ishlatsangiz, shu yerda ulashing
// import $ from 'jquery';
// window.$ = $;
