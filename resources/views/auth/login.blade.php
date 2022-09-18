@extends('layouts.app')

@section('title', 'Login')

@section('extraHead')
    <link rel="stylesheet" href="{{ getCssJsPath('/css/generic.css') }}">
@endsection

@section('content')
    <div class="row align-items-center h-100 justify-content-center px-3">
        <div class="col-12 col-md-12 p-3" style="max-width: 400px;">

            <form method="post" action="{{ route('login') }}">
                @csrf

                @if ( $errors->first('errore') )
                    <div class="alert alert-danger text-center">{{ $errors->first('errore') }}</div>
                @endif

                <div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-at"></i>
                                </span>
                        </div>
                        <input type="email" id="email" name="email" required autocomplete="email"
                               class="form-control border-0 @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" style="outline: 0; box-shadow: none;" placeholder="<?= ucfirst(strtolower(__('general.email')))?>">
                        @error('email')
                        <div class="invalid-feedback alert alert-danger text-center">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-key"></i>
                                </span>
                        </div>
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                               class="form-control border-0 @error('password') is-invalid @enderror" style="outline: 0; box-shadow: none;"
                               placeholder="<?= capitalize(__('general.password'))?>">
                        @error('password')
                        <div class="invalid-feedback alert alert-danger text-center">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <input type="submit" class="btn btn-outline-light" value="<?= capitalize(__('general.login')) ?>">
                </div>
            </form>
        </div>
    </div>
@endsection
