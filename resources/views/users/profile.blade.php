@extends('adminlte::page')

@section('extraHead')
    <link href="{{ getCssJsPath('css/advSite.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('errors')
            @include('successmsg')

            <form method="post" action="{{ route('user.update.profile') }}">
                @csrf
                <fieldset>
                    <div class="row title">DATI UTENTE</div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-12">
                            <label for="name" class="mb-0">Nome</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('name')) ? 'is-invalid' : '' }}"
                                   id="name" name="name" value="{{ old('name') ? old('name') : $user->name }}">
                            @if ( ! empty($errors->first('name')) )
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-12">
                            <label for="email" class="mb-0">Email</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('email')) ? 'is-invalid' : '' }}"
                                   id="email" name="email" value="{{ old('email') ? old('email') : $user->email }}">
                            @if ( ! empty($errors->first('email')) )
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <input type="submit" class="btn btn-success" value="SALVA">
                    </div>
                </fieldset>
            </form>

            <form method="post" action="{{ route('user.updatePassword.profile') }}">
                @csrf
                <fieldset>
                    <div class="row title">MODIFICA PASSWORD</div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="password" class="mb-0">Nuova password</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('password')) ? 'is-invalid' : '' }}"
                                   id="password" name="password" value="{{ old('password') ? old('password') : '' }}">
                            @if ( ! empty($errors->first('password')) )
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="password_confirmation" class="mb-0">Ripeti passwoord</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('password_confirmation')) ? 'is-invalid' : '' }}"
                                   id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') ? old('password_confirmation') : '' }}">
                            @if ( ! empty($errors->first('password_confirmation')) )
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <input type="submit" class="btn btn-success" value="SALVA">
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
@endsection
