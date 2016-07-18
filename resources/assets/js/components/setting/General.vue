<template>
	<div id="root">
		<setting-photo 
		:user.sync="user">
        </setting-photo>
        <setting-contact
        :user.sync="user"
        :form-contact-errors.sync="formContactErrors">
        </setting-contact>
	</div>
</template>

<script>
	import SettingPhoto from './Photo.vue';
	import SettingContact from './Contact.vue';

	export default {
		components: {
	        SettingPhoto,
	        SettingContact
	    },

	    ready () {
	    	this.getUser();
	    },

	    data () {
	    	return {
		      	user: {
		            user_info: {
		              photo: ''
		            }
		        },
			}
	    },

	    methods: {
	    	getUser () {
	            var self = this;

	            this.$http.get('/api/v1/user').then(function (response) {
	                self.$set('user', response.json().user);
	            })
	        }
	    }
	}
</script>