<template>
	<div>
		<div class="panel panel-info">
            <div class="panel-heading">Изображение профиля</div>

            <div class="panel-body panel-photo">

                
                <div class="alert alert-danger text-left" v-if="formPhotoErrors">
                    <p class="text-danger">{{ formPhotoErrors.photo }}</p>
                </div>

                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="formPhoto" @submit.prevent="submitPhoto">

                    <div class="form-group">
                        <div class="col-md-12">
                            <span role="img" class="profile-photo-preview" 
                            :style="{ 'background-image': 'url(' + user.user_info.photo + ')' }"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label type="button" class="btn btn-primary btn-upload">
                                <span>Выберите новое изображение</span>
                                <input type="file" class="form-control" name="photo" @change="submitPhoto">
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</template>

<script>
	export default {
  		props: ['user', 'formPhotoInput', 'formPhotoErrors'],

  		http: {
  			headers: {
  				'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('content')
  			}
  		},
        
  		methods: {
  			submitPhoto: function submitPhoto(e) {
		      	var self = this;
		        var form = $('#formPhoto');
            var navPhoto = $('#navPhoto');
		        var formData = new FormData(form[0]);

		        this.$parent.formPhotoInput = formData;

		      	this.$http.post('/setting/photo', this.$parent.formPhotoInput).then(function (response) {
		          	form.onsubmit = function() {
		              return false;
		        	} 
		        	self.$parent.$set('user.user_info.photo', response.json().image);
              navPhoto.attr('src', self.user.user_info.photo);
		        })
		        .catch(function (data, status, request) {
		          var errors = data.json().errors;
		          this.formPhotoErrors = errors;
		        })

		        setTimeout(function () {
	        		self.$parent.$set('formPhotoErrors', false)
	        	}, 5000);
		    }
  		}
	}
</script>