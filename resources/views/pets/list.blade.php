@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('pet.list_title')) }}</h2>
            </div>

            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="btn btn-success m-1" href="{{ route('pet.create') }}">{{ __('pet.create_pet') }}</a>
            </div>

            <div class="col-12">
                <table id="pets_table" class="display w-100">
                    <thead>
                    <tr>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                        <th>{{ strtoupper(__('table.name')) }}</th>
                        <th>{{ strtoupper(__('general.very_strong_against')) }}</th>
                        <th>{{ strtoupper(__('general.strong_against')) }}</th>
                        <th>{{ strtoupper(__('general.very_weak_against')) }}</th>
                        <th>{{ strtoupper(__('general.weak_against')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pets as $pet)
                        <tr>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('pet.edit', $pet->id) }}"><i class="fas fa-edit"></i></a>
                                <div class="btn btn-sm btn-danger" onclick="deletePet({{ $pet->id }})"><i class="fas fa-trash-alt"></i></div>
                                <div class="d-none">
                                    <form id="deletePetForm_{{ $pet->id }}" action="{{ route('pet.delete', $pet->id) }}" method="post">@csrf</form>
                                </div>
                            </td>
                            <td>{{ $pet->name }}</td>
                            <td>
                                <ul>
                                @foreach($pet->vsa as $petVSA)
                                    <li><a href="{{ route('pet.edit', $petVSA->id) }}">{{ $petVSA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($pet->sa as $petSA)
                                    <li><a href="{{ route('pet.edit', $petSA->id) }}">{{ $petSA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($pet->vwa as $petVWA)
                                    <li><a href="{{ route('pet.edit', $petVWA->id) }}">{{ $petVWA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($pet->wa as $petWA)
                                    <li><a href="{{ route('pet.edit', $petWA->id) }}">{{ $petWA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

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
            $('#pets_table').DataTable({
                scrollX: true,
                language: datatable_translation
            });
        } );

        function deletePet (_playerId) {
            if ( confirm('{{ __('pet.confirm_to_delete') }}') )
                if ( confirm('{{ __('pet.confirm_again_to_delete') }}') )
                    $('#deletePetForm_' + _playerId).submit();
        }
    </script>
@endsection