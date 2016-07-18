<template>
    <div class="panel panel-info">
        <div class="panel-heading">Контактная информация</div>

        <div class="panel-body">

            <div class="alert alert-danger text-left" v-if="formContactErrors">
                <p class="text-danger" v-for="error in formContactErrors">
                    {{ error[0] }}
                </p>
            </div>

            <div class="alert alert-success text-left" v-if="success.status">
                <p class="text-success">
                    {{ success.text }}
                </p>
            </div>

            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="formContact" @submit.prevent="submitContactInfo">

                <div class="form-group">
                    <label class="col-md-4 control-label">ФИО</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" v-model="user.name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">E-mail</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="email" v-model="user.email">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-4">&nbsp;</label>

                    <div class="col-md-6">
                        <button class="btn btn-primary">
                            Обновить
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'formContactErrors'],

        http: {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('content')
            }
        },

        data: function () {
            return {
                success: {
                    status: false,
                    text: ''
                }
            }
        },

        methods: {
            submitContactInfo: function submitContactInfo(e) {
                var self = this;
                var form = $('#formContact');
                var formData = JSON.stringify(this.user);

                this.$http.post('/setting/contact', formData).then(function (status, response) {
                    form.onsubmit = function() {
                      return false;
                    }

                    if (status.status == 200) {
                        self.success.status = true;
                        self.success.text = 'Данные успешно обновлены!';

                        setTimeout(function () {
                            self.success.status = false
                        }, 5000);
                    }
                })
                .catch(function (data, status, request) {
                    var errors = data.json().errors;
                    self.formContactErrors = errors;
                })

                setTimeout(function () {
                    self.$parent.$set('formContactErrors', false)
                }, 5000);
            }
        }
    }
</script>