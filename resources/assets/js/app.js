
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
// window.VueRouter = require('vue-router');

// Vue.use(VueRouter);

// const Home = require('./page/home');
// Vue.component('my-component' ,{
// 	template: '<span> {{item.message}}</span>',
// 	data: function(){
// 		return {
// 			items: [
// 		      { message: 'Foo' },
// 		      { message: 'Bar' }
// 		    ]
// 		}
// 	}
// });
// const router = new VueRouter({
// 	routes:[
// 		{
// 			path:'/list',
// 			component: Home
// 		}
// 	]
// });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));


// const app = new Vue({
// 	el:'#app',
// 	components:{ Home }
// })

$('.dropdown').mouseover(function(){
	$(this).find('.dropdown-menu').show();
}).mouseout(function(){
	$(this).find('.dropdown-menu').hide();
})
