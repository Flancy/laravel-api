import Vue from 'vue';
import VueResource from 'vue-resource';
import Vuex from 'vuex';

import Setting from './components/setting/General.vue';

Vue.use(VueResource);
Vue.use(Vuex);

var vm = new Vue({
    el: '#app',

    http: {
        headers: {
          'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('content')
        }
    },

    data: {
      	//
    },

    components: {
        Setting
    },

    methods: {
        //
    },

    ready: function () {
        //
    }
});