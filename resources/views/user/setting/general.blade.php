@extends('layouts.app')

@section('content')
    <div class="container setting">
        <div class="row">

            @include('user.setting.nav')

            @section('general')
                <div class="col-md-9">
                    <div class="panel panel-info">
                        <div class="panel-heading">Изображение профиля</div>

                        <div class="panel-body panel-photo">

                            
                            <div class="alert alert-danger text-left" v-if="formPhotoErrors.photo">
                                <p class="text-danger">@{{ formPhotoErrors.photo }}</p>
                            </div>

                            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="formPhoto" @submit.prevent="submitPhoto">
                                
                                {{ csrf_field() }}

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

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="submit" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-info">
                        <div class="panel-heading">General</div>

                        <div class="panel-body">
                            You are logged in!
                        </div>
                    </div>
                </div>
            @show
        </div>
    </div>
@endsection