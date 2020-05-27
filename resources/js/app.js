/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//import Swal from 'sweetalert2'

window.Swal = require('sweetalert2')

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('export', require('./components/ExportComponent.vue').default);
Vue.component('search', require('./components/SearchComponent.vue').default);
Vue.component('orderby', require('./components/OrderbyComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});


jQuery(window).ready(function(){

	$("#toTop").click(function (){
        $("html, body").animate({scrollTop: 0}, 500);
    });

    $(".btn-confirm").click(function (e){
    	e.preventDefault();
    	var elem = $(this);

    	var Msg = (elem.data('msg')) ? elem.data('msg') : "Mensaje del dialogo";
    	var Title = (elem.data('title')) ? elem.data('title') : "¿Estas seguro?";
		var CancelButton = (elem.data('cancelbtn')) ? elem.data('cancelbtn') : "Cancelar";
		var ConfirmButton = (elem.data('confirmbtn')) ? elem.data('confirmbtn') : "Confirmar";
		var Destino = (elem.data('url')) ? elem.data('url') : "#";

		Swal.fire({
			title: Title,
			text: Msg,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: CancelButton,
			confirmButtonText: ConfirmButton
		}).then((result) => {
			if (result.value) {
				location.href=Destino;
			}
		})
    });

    $(window).scroll(function() {
        if ($(this).scrollTop()) $('#toTop').fadeIn();
        else $('#toTop').fadeOut();
    });

    //para mostrar los mensajes de alertas
    // setTimeout(function() {
    //     $(".alert-app").alert('close');
    // }, 3000);
});

