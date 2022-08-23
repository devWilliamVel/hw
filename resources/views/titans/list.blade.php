@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('titan.list_title')) }}</h2>
            </div>

            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="btn btn-success m-1" href="{{ route('titan.create') }}">{{ __('titan.create_titan') }}</a>
            </div>

            <div class="col-12">
                <table id="titans_table" class="display">
                    <thead>
                    <tr>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                        <th>{{ strtoupper(__('table.name')) }}</th>
                        <th>{{ strtoupper(__('titan.element')) }}</th>
                        <th>{{ strtoupper(__('general.very_strong_against')) }}</th>
                        <th>{{ strtoupper(__('general.strong_against')) }}</th>
                        <th>{{ strtoupper(__('general.very_weak_against')) }}</th>
                        <th>{{ strtoupper(__('general.weak_against')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($titans as $titan)
                        <tr>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('titan.edit', $titan->id) }}"><i class="fas fa-edit"></i></a>
                                <div class="btn btn-sm btn-danger" onclick="deleteTitan({{ $titan->id }})"><i class="fas fa-trash-alt"></i></div>
                                <div class="d-none">
                                    <form id="deleteTitanForm_{{ $titan->id }}" action="{{ route('titan.delete', $titan->id) }}" method="post">@csrf</form>
                                </div>
                            </td>
                            <td>{{ $titan->name }}</td>
                            <td class="d-flex justify-content-center">
                                @if($titan->element == \App\Models\TitanModel::ELEMENT_FIRE)
                                    @php($elementClassC = 'fire-container')
                                @elseif($titan->element == \App\Models\TitanModel::ELEMENT_EARTH)
                                    @php($elementClassC = 'earth-container')
                                @else
                                    @php($elementClassC = 'water-container')
                                @endif
                                <div class="element-container {{ $elementClassC }}">{{ $elements[$titan->element] }}</div>
                            </td>
                            <td>
                                <ul>
                                @foreach($titan->vsa as $titanVSA)
                                    @if($titanVSA->element == \App\Models\TitanModel::ELEMENT_FIRE)
                                        @php($elementClassT = 'fire-text')
                                    @elseif($titanVSA->element == \App\Models\TitanModel::ELEMENT_EARTH)
                                        @php($elementClassT = 'earth-text')
                                    @else
                                        @php($elementClassT = 'water-text')
                                    @endif

                                    <li><a class="{{ $elementClassT }}" href="{{ route('titan.edit', $titanVSA->id) }}">{{ $titanVSA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($titan->sa as $titanSA)
                                        @if($titanSA->element == \App\Models\TitanModel::ELEMENT_FIRE)
                                            @php($elementClassT = 'fire-text')
                                        @elseif($titanSA->element == \App\Models\TitanModel::ELEMENT_EARTH)
                                            @php($elementClassT = 'earth-text')
                                        @else
                                            @php($elementClassT = 'water-text')
                                        @endif

                                        <li><a class="{{ $elementClassT }}" href="{{ route('titan.edit', $titanSA->id) }}">{{ $titanSA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($titan->vwa as $titanVWA)
                                        @if($titanVWA->element == \App\Models\TitanModel::ELEMENT_FIRE)
                                            @php($elementClassT = 'fire-text')
                                        @elseif($titanVWA->element == \App\Models\TitanModel::ELEMENT_EARTH)
                                            @php($elementClassT = 'earth-text')
                                        @else
                                            @php($elementClassT = 'water-text')
                                        @endif

                                        <li><a class="{{ $elementClassT }}" href="{{ route('titan.edit', $titanVWA->id) }}">{{ $titanVWA->name }}</a></li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                @foreach($titan->wa as $titanWA)
                                        @if($titanWA->element == \App\Models\TitanModel::ELEMENT_FIRE)
                                            @php($elementClassT = 'fire-text')
                                        @elseif($titanWA->element == \App\Models\TitanModel::ELEMENT_EARTH)
                                            @php($elementClassT = 'earth-text')
                                        @else
                                            @php($elementClassT = 'water-text')
                                        @endif

                                        <li><a class="{{ $elementClassT }}" href="{{ route('titan.edit', $titanWA->id) }}">{{ $titanWA->name }}</a></li>
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
    <style>
        .element-container{
            padding: 0.25rem 0.5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
            text-align: center;
            vertical-align: middle;
            display: inline-block;
            font-weight: 400;
        }
        .fire-container{
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
            box-shadow: none;
        }
        .earth-container{
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            box-shadow: none;
        }
        .water-container{
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
            box-shadow: none;
        }
        .fire-text{ color: #dc3545; }
        .earth-text{ color: #28a745; }
        .water-text{ color: #007bff; }
    </style>
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
            $('#titans_table').DataTable({
                //'searching': false
            });
        } );

        function deleteTitan (_playerId) {
            if ( confirm('{{ __('titan.confirm_to_delete') }}') )
                if ( confirm('{{ __('titan.confirm_again_to_delete') }}') )
                    $('#deleteTitanForm_' + _playerId).submit();
        }
    </script>
@endsection