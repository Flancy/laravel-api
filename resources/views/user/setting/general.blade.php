@extends('layouts.app')

@section('content')
    <div class="container setting">
        <div class="row">

            @include('user.setting.nav')

            @section('general')
                <div class="col-md-9">
                    <setting-photo 
                    :user.sync="user"
                    :form-photo-input.sync="formPhotoInput"
                    :form-photo-errors.sync="formPhotoErrors"></setting-photo>

                    
                    <setting-contact
                    :user.sync="user"
                    :form-contact-errors.sync="formContactErrors"></setting-contact>
                </div>
            @show
        </div>
    </div>
@endsection