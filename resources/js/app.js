/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
//import VueDisqus from 'vue-disqus';

window.Vue = require('vue').default;
// Vue.use(VueDisqus, {
//     shortname: 'chobidisqus'
//   });

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('album', require('./components/AlbumComponent.vue').default);
Vue.component('index', require('./components/IndexComponent.vue').default);
Vue.component('edit', require('./components/EditComponent.vue').default);
Vue.component('upload', require('./components/UploadComponent.vue').default);
Vue.component('show', require('./components/ShowComponent.vue').default);
Vue.component('disqus', require('./components/DisqusComponent.vue').default);
Vue.component('follow', require('./components/FollowComponent.vue').default);
Vue.component('avatar', require('./components/AvatarComponent.vue').default);
Vue.component('bgpic', require('./components/BackgroundComponent.vue').default);
Vue.component('cardalbum', require('./components/CardalbumComponent.vue').default); 
Vue.component('pagination', require('./components/PaginationComponent.vue').default);
Vue.component('add-image', require('./components/AddImageComponent.vue').default);
Vue.component('image-card', require('./components/ImageCardComponent.vue').default);
Vue.component('home-images', require('./components/HomeImagesComponent.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
