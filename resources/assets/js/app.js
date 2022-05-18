
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

const test=document.getElementById("msgtest");
Echo.channel('free-channel')
    .listen('.Commande-notification-event', (e) => {
        console.log(e.msg);
        console.log(e.data.name);
        $('#cnt').addClass('bg-danger');
        var num=Number(e.msg) ; 
        test.innerHTML= Number(test.innerHTML)+num;
      $( '<a class="dropdown-item preview-item">'+
        '<div class="preview-thumbnail">'+
          '<div class="preview-icon ">'+
            '<i class="mdi mdi-receipt text-warning"></i>'+
          '</div>'+
        '</div>'+
       '<div class="preview-item-content d-flex align-items-start flex-column justify-content-center">'+
          '<h6 class="preview-subject font-weight-normal mb-1">Commande</h6>'+
          '<p class="text-gray ellipsis mb-0"> '+e.data.nomclient+' a passé une commande</p>'+
        '</div>'+
      '</a>'+
      '<div class="dropdown-divider"></div></div>' ).insertAfter( "#after" );
        // console.log(e.msg);
    });
