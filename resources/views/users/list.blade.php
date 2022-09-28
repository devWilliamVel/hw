@extends('adminlte::page')

@section('extraHead')
    {{-- JQuery library --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- Popper JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.0/umd/popper.min.js"></script>
    {{-- Bootstrap CDN --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/plugins/responsive.bootstrap4.min.css">
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <h2>{{ strtoupper(__('users.users')) }}</h2>
        </div>

        <div class="container-fluid">

            <table id="usersTable" class="display w-100">
                <thead class="dataTableHead">
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="usersTable"></th>
                    <th class="sorting_asc" tabindex="1" aria-controls="usersTable">{{ __('users.player') }}</th>
                    <th class="sorting" tabindex="2" aria-controls="usersTable">{{ __('users.active') }}</th>
                    <th class="sorting" tabindex="3" aria-controls="usersTable">{{ __('users.admin') }}</th>
                    <th class="sorting" tabindex="4" aria-controls="usersTable">{{ __('users.name') }}</th>
                    <th class="sorting" tabindex="5" aria-controls="usersTable">{{ __('users.email') }}</th>
                    <th class="sorting" tabindex="6" aria-controls="usersTable">{{ __('users.updated_at') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}">
                                <i class="fas fa-edit primaryColor"></i>
                            </a>
                            {{--<a href="javascript:void(0)" --}}{{--onclick="deleteAdvSito({{ $advSito->idSito }})"--}}{{-->
                                <i class="fas fa-trash-alt primaryColor"></i>
                            </a>--}}
                        </td>
                        <td class="text-center">{{ $user->player }}</td>
                        <td class="text-center">
                            @if ( intval($user->active) )
                                <div class="btn btn-sm btn-danger" style="border-radius: 15px" onclick="enableDisableUser({{$user->id}})">{{ __('users.disable') }}</div>
                            @else
                                <div class="btn btn-sm btn-success" style="border-radius: 15px" onclick="enableDisableUser({{$user->id}})">{{ __('users.enable') }}</div>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ( $user->is_admin )
                                {{ __('users.yes') }}
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        @if ( isset($errorMsg) && strlen($errorMsg) )
        alert('{{ $errorMsg }}');
        @elseif ( isset($successMsg) && strlen($successMsg) )
        alert('{{ $successMsg }}');
        @endif

        $(document).ready( function () {
            $('#usersTable').DataTable({
                scrollX: true,
                language: datatable_translation
            });
        } );

        function deleteHero (_playerId) {
            if ( confirm('{{ __('hero.confirm_to_delete') }}') )
                if ( confirm('{{ __('hero.confirm_again_to_delete') }}') )
                    $('#deleteHeroForm_' + _playerId).submit();
        }
    </script>
@endsection
