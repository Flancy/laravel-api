import Vue from 'vue';
import VueResource from 'vue-resource';

Vue.use(VueResource);

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
    formPhotoErrors: {},
  	loading: false
  },

  methods: {
  	getUser: function getUser() {
  		var self = this;

  		this.loading = true;

  		this.$http.get('/api/v1/user').then(function (response) {
  			self.$set('user', response.json().user);

  			self.loading = false;
  		})
  	},
    submitPhoto: function submitPhoto(e) {
      var self = this;
      var form = $('#formPhoto');
      var formData = new FormData(form[0]);
      this.formPhotoInput = formData;

      this.$http.post('/setting/photo', this.formPhotoInput).then(function (response) {
        form.onsubmit = function() {
          return false;
        }
        self.$set('user.user_info.photo', response.json().image);
      })
      .catch(function (data, status, request) {
        var errors = data.json().errors;
        this.formPhotoErrors = errors;
      })
    }
  },

  ready: function () {
  	this.getUser();
  }
});