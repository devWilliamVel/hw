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
            <h2>UTENTI</h2>
        </div>

        <div class="container-fluid">

            <table id="usersTable" class="datatable-responsive display nowrap mt-2 w-100">
                <thead class="dataTableHead">
                <tr>
                    <th class="sorting" tabindex="0" aria-controls="usersTable"></th>
                    <th class="sorting_asc" tabindex="1" aria-controls="usersTable">Id</th>
                    <th class="sorting" tabindex="2" aria-controls="usersTable">Attivo</th>
                    <th class="sorting" tabindex="3" aria-controls="usersTable">Admin</th>
                    <th class="sorting" tabindex="4" aria-controls="usersTable">Nome</th>
                    <th class="sorting" tabindex="5" aria-controls="usersTable">Email</th>
                    <th class="sorting" tabindex="6" aria-controls="usersTable">Data Registrazione</th>
                    <th class="sorting" tabindex="7" aria-controls="usersTable">Ultima modifica</th>
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
                        <td class="text-center">{{ $user->id }}</td>
                        <td class="text-center">
                            @if ( intval($user->active) )
                                <div class="btn btn-sm btn-danger" style="border-radius: 15px" onclick="enableDisableUser({{$user->id}})">DISATTIVA</div>
                            @else
                                <div class="btn btn-sm btn-success" style="border-radius: 15px" onclick="enableDisableUser({{$user->id}})">ATTIVA</div>
                            @endif
                        </td>
                        <td class="text-center">{{ $user->is_admin }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">{{ $user->created_at }}</td>
                        <td class="text-center">{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
                </tbody>
                {{--<tfoot class="dataTableHead">
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Attivo</th>
                    <th>Admin</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data Registrazione</th>
                    <th>Ultima modifica</th>
                </tr>
                </tfoot>--}}
            </table>
        </div>
    </div>
@stop

@section('extraScripts')
    <script src="{{ url('/') }}/js/plugins/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/js/plugins/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/js/plugins/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('/') }}/js/plugins/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/js/plugins/responsive.bootstrap4.min.js"></script>
@stop

@section('personalizedScripts')
    <script src="{{ getCssJsPath('js/users.js') }}"></script>
@stop

@section('extraContent')
@stop
