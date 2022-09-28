@extends('adminlte::page')

@section('extraHead')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @include('errors')
            @include('successmsg')

            <form method="post" action="{{ route('user.update', $user->id) }}">
                @csrf
                <fieldset>
                    <div class="row title">{{ strtoupper(__('users.user_data')) }}</div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-12">
                            <label for="name" class="mb-0">{{ __('users.name') }}</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('name')) ? 'is-invalid' : '' }}"
                                   id="name" name="name" value="{{ old('name') ? old('name') : $user->name }}">
                            @if ( ! empty($errors->first('name')) )
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-12">
                            <label for="email" class="mb-0">{{ __('users.email') }}</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('email')) ? 'is-invalid' : '' }}"
                                   id="email" name="email" value="{{ old('email') ? old('email') : $user->email }}">
                            @if ( ! empty($errors->first('email')) )
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="active" class="mb-0">{{ __('users.active') }}</label>
                            <input type="checkbox" class="input-create-adv ml-2{{ ! empty($errors->first('active')) ? 'is-invalid' : '' }}"
                                   id="active" name="active" {{ $user->active ? 'checked' : '' }}>
                            @if ( ! empty($errors->first('active')) )
                                <div class="invalid-feedback">{{ $errors->first('active') }}</div>
                            @endif
                        </div>
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="is_admin" class="mb-0">{{ __('users.admin') }}</label>
                            <input type="checkbox" class="input-create-adv ml-2{{ ! empty($errors->first('is_admin')) ? 'is-invalid' : '' }}"
                                   id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
                            @if ( ! empty($errors->first('is_admin')) )
                                <div class="invalid-feedback">{{ $errors->first('is_admin') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <input type="submit" class="btn btn-success" value="{{ strtoupper(__('users.save')) }}">
                    </div>
                </fieldset>
            </form>

            <form method="post" action="{{ route('user.updatePassword', $user->id) }}">
                @csrf
                <fieldset>
                    <div class="row title">{{ strtoupper(__('users.password_change')) }}</div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="password" class="mb-0">{{ __('users.new_password') }}</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('password')) ? 'is-invalid' : '' }}"
                                   id="password" name="password" value="{{ old('password') ? old('password') : '' }}">
                            @if ( ! empty($errors->first('password')) )
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="password_confirmation" class="mb-0">{{ __('users.confirm_password') }}</label>
                            <input type="text" class="form-control input-create-adv {{ ! empty($errors->first('password_confirmation')) ? 'is-invalid' : '' }}"
                                   id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') ? old('password_confirmation') : '' }}">
                            @if ( ! empty($errors->first('password_confirmation')) )
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <input type="submit" class="btn btn-success" value="{{ strtoupper(__('users.save')) }}">
                    </div>
                </fieldset>
            </form>

            <form method="post" action="{{ route('user.setPlayer') }}">
                @csrf
                <fieldset>
                    <div class="row title">{{ strtoupper(__('users.assign_player')) }}</div>
                    <div class="form-row">
                        <div class="form-group form-group-create-adv col-md-6">
                            <label class="mb-0">{{ __('users.assigned_player') }}</label>
                            <input type="text" class="form-control input-create-adv" value="{{ $player->name ?? '' }}" disabled>
                            <input type="hidden" name="assignedPlayer" value="{{ $player->id ?? 0 }}" disabled>
                        </div>
                        <div class="form-group form-group-create-adv col-md-6">
                            <label for="playerId" class="mb-0">{{ __('users.players_to_assign') }}</label>
                            <select name="playerId" id="playerId" class="form-control {{ ! empty($errors->first('playerId')) ? 'is-invalid' : '' }}">
                                <option value="">Choose...</option>
                                @foreach ( $notAssignedPlayers as $notAssignedPlayer )
                                    <option value="{{ $notAssignedPlayer->id }}">{{ $notAssignedPlayer->name }}</option>
                                @endforeach
                            </select>
                            @if ( ! empty($errors->first('playerId')) )
                                <div class="invalid-feedback">{{ $errors->first('playerId') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <input type="submit" class="btn btn-success" value="{{ strtoupper(__('users.save')) }}">
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if ( isset($errorMsg) && strlen($errorMsg) )
        alert('{{ $errorMsg }}');
        @elseif ( isset($successMsg) && strlen($successMsg) )
        alert('{{ $successMsg }}');
        @endif

        $(document).ready( function () {
            $('#playerId').select2({
                width: '100%'
            });
        } );
    </script>
@endsection