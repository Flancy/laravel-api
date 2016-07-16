@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            @include('user.setting.nav')

            @section('general')
                <div class="col-md-9">
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