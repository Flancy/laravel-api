import Vue from 'vue';
import VueResource from 'vue-resource';

Vue.use(VueResource);

var vm = new Vue({
  el: '#app',

  /*
  http: {
    headers: {
      'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
    }
  },
  */
  data: {
  	user: {
  		user_info: {
  			photo: ''
  		}
  	},
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
  	}
  },

  ready: function () {
  	this.getUser();
  }
});