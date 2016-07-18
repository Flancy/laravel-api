import Vue from 'vue';
import VueResource from 'vue-resource';
import Vuex from 'vuex';

import SettingPhoto from './components/setting/Photo.vue';
import SettingContact from './components/setting/Contact.vue';

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
      	user: {
            user_info: {
              photo: ''
            }
        },

        formPhotoInput: {},
        formPhotoErrors: false,
        
        formContactErrors: false,

        loading: false
    },

    components: {
        SettingPhoto,
        SettingContact
    },

    methods: {
        getUser: function getUser() {
            var self = this;

            this.loading = true;

            this.$http.get('/api/v1/user').then(function (response) {
                self.$set('user', response.json().user);

                self.loading = false;
            })
        }
    },

    ready: function () {
        this.getUser();
    }
});