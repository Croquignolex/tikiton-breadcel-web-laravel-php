@extends('layouts.auth', ['page' => 'Reinitialisation'])

@section('form') 
    <form role="form" method="POST" action="">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group"> 
            <input type="text" class="form-control" name="name" value="{{ $name ?? old('name') }}" readonly="">  
        </div>

        <div class="form-group"> 
            <input placeholder="E-mail" type="text" class="form-control" name="email" value="{{ $email ?? old('email') }}" readonly="">   
        </div>

        @include('partials.forms.input', ['placeholder' => 'Mot de passe', 'type' => 'password',
            'name' => 'password', 'min' => 6, 'value' => old('password')])

        @include('partials.forms.input', ['placeholder' => 'Resaisir le mot de passe', 'type' => 'password',
           'name' => 'password_confirmation', 'value' => old('password_confirmation')])


        @include('partials.forms.submit', ['id' => 'resetPassword', 'icon' => 'redo',
               'label' => 'Réinitialiser'])

        <div class="form-group text-center">
            Vous avez déjà un compte? <a href="{{ route_manager('login') }}" class="btn btn-default">Connectez-vous</a>
        </div>  
    </form> 
@endsection
