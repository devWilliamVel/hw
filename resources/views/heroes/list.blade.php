@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('hero.list_title')) }}</h2>
            </div>

            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="btn btn-success m-1" href="{{ route('hero.create') }}">{{ __('hero.create_hero') }}</a>
            </div>

            <div class="col-12">
                <table id="heroes_table" class="display">
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
                    @foreach($heroes as $hero)
                        <tr>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('hero.edit', $hero->id) }}"><i class="fas fa-edit"></i></a>
                                <div class="btn btn-sm btn-danger" onclick="deleteHero({{ $hero->id }})"><i class="fas fa-trash-alt"></i></div>
                                <div class="d-none">
                                    <form id="deleteHeroForm_{{ $hero->id }}" action="{{ route('hero.delete', $hero->id) }}" method="post">@csrf</form>
                                </div>
                            </td>
                            <td>{{ $hero->name }}</td>
                            <td>
                                <ul>
                                @foreach($hero->vsa as $heroVSA)
                                    <li><a href="{{ route('hero.edit', $heroVSA->id) }}">{{ $heroVSA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($hero->sa as $heroSA)
                                    <li><a href="{{ route('hero.edit', $heroSA->id) }}">{{ $heroSA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($hero->vwa as $heroVWA)
                                    <li><a href="{{ route('hero.edit', $heroVWA->id) }}">{{ $heroVWA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($hero->wa as $heroWA)
                                    <li><a href="{{ route('hero.edit', $heroWA->id) }}">{{ $heroWA->name }}</a></li>
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
            $('#heroes_table').DataTable({
                //'searching': false
            });
        } );

        function deleteHero (_playerId) {
            if ( confirm('{{ __('hero.confirm_to_delete') }}') )
                if ( confirm('{{ __('hero.confirm_again_to_delete') }}') )
                    $('#deleteHeroForm_' + _playerId).submit();
        }
    </script>
@endsection