@extends('adminlte::page')

@section('extraHead')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-3">NUEVO USUARIO</h2>

                @include('errors')
                @include('successmsg')

                <form method="post" action="{{ route('register') }}">
                    @csrf
                    <fieldset>
                        <div class="row title">DATOS DE USUARIO</div>
                        <div class="form-group row form-group-create-per mt-2">
                            <label for="name" class="mb-0 col-sm-12 col-md-3 text-sm-left text-md-right">Nombre</label>
                            <div class="mb-0 col-sm-12 col-md-9">
                                <input type="text" id="name" name="name" required autocomplete="name" autofocus
                                       class="form-control form-control-sm @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row form-group-create-per">
                            <label for="email" class="mb-0 col-sm-12 col-md-3 text-sm-left text-md-right">Email</label>
                            <div class="mb-0 col-sm-12 col-md-9">
                                <input type="email" id="email" name="email" required autocomplete="email"
                                       class="form-control form-control-sm @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row form-group-create-per">
                            <label for="password" class="mb-0 col-sm-12 col-md-3 text-sm-left text-md-right">Password</label>
                            <div class="mb-0 col-sm-12 col-md-9">
                                <input type="password" id="password" name="password" required autocomplete="new-password"
                                       class="form-control form-control-sm @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row form-group-create-per">
                            <label for="password_confirmation" class="mb-0 col-sm-12 col-md-3 text-sm-left text-md-right">Repetir password</label>
                            <div class="mb-0 col-sm-12 col-md-9">
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="form-control form-control-sm" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row form-group-create-per">
                            <div class="mb-0 col-1 col-md-3 text-right">
                                <input type="checkbox" id="active" name="active" required>
                            </div>
                            <label for="active" class="mb-0 col-11 col-md-9 text-left">Activo</label>
                        </div>
                        <div class="form-row justify-content-center">
                            <input type="submit" class="btn btn-success" value="REGISTRAR USUARIO">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
