@extends('layouts.app')

@section('content')
    <div class="container setting">
        <div class="row">

            @include('user.setting.nav')

            @section('general')
                <div class="col-md-9">
                    <setting></setting>
                </div>
            @show
        </div>
    </div>
@endsection