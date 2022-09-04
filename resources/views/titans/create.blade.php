@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('titan.create_titan')) }}</h2>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center align-items-baseline flex-wrap">
                <Label class="label-per" for="titanName">{{ ucfirst(__('general.name')) }}:</Label>
                <input type="text" class="input-per" id="titanName">
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center align-items-baseline flex-wrap">
                <Label class="label-per" for="titanElement">{{ ucfirst(__('titan.element')) }}:</Label>
                <select class="input-per" id="titanElement">
                    @foreach ( $elements as $key=>$name )
                        <option value="{{ $key }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 container-titans">
                <h4 class="text-center">{{ ucfirst(__('general.very_strong_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="titansVSA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalVSA()">{{ __('titan.add_titan') }}</div>
                </div>
            </div>
            <div class="col-12 container-titans">
                <h4 class="text-center">{{ ucfirst(__('general.strong_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="titansSA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalSA()">{{ __('titan.add_titan') }}</div>
                </div>
            </div>
            <div class="col-12 container-titans">
                <h4 class="text-center">{{ ucfirst(__('general.very_weak_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="titansVWA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalVWA()">{{ __('titan.add_titan') }}</div>
                </div>
            </div>
            <div class="col-12 container-titans">
                <h4 class="text-center">{{ ucfirst(__('general.weak_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="titansWA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalWA()">{{ __('titan.add_titan') }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="btn btn-warning m-1" href="{{ route('titans') }}">{{ strtoupper(__('general.back')) }}</a>
                <div class="btn btn-success m-1" onclick="store()">{{ strtoupper(__('titan.create_titan')) }}</div>
            </div>
        </div>
    </div>

    {{-- ADD TITAN VSA MODAL --}}
    <div class="modal fade" id="addTitanVSAModal" tabindex="-1" role="dialog" aria-labelledby="addTitanVSAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTitanVSAModalTitle">{{ strtoupper(__('general.very_strong_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addTitanVSAModalSelect">{{ __('titan.add_titan') }}</label>
                        <select class="form-control" id="addTitanVSAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addVSATitan()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD TITAN SA MODAL --}}
    <div class="modal fade" id="addTitanSAModal" tabindex="-1" role="dialog" aria-labelledby="addTitanSAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTitanSAModalTitle">{{ strtoupper(__('general.strong_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addTitanSAModalSelect">{{ __('titan.add_titan') }}</label>
                        <select class="form-control" id="addTitanSAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addSATitan()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD TITAN VWA MODAL --}}
    <div class="modal fade" id="addTitanVWAModal" tabindex="-1" role="dialog" aria-labelledby="addTitanVWAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTitanVWAModalTitle">{{ strtoupper(__('general.very_weak_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addTitanVWAModalSelect">{{ __('titan.add_titan') }}</label>
                        <select class="form-control" id="addTitanVWAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addVWATitan()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD TITAN WA MODAL --}}
    <div class="modal fade" id="addTitanWAModal" tabindex="-1" role="dialog" aria-labelledby="addTitanWAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTitanWAModalTitle">{{ strtoupper(__('general.weak_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addTitanWAModalSelect">{{ __('titan.add_titan') }}</label>
                        <select class="form-control" id="addTitanWAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addWATitan()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
        .container-titans{
            border: 1px solid #007bff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-titan{
            background-color: #004080;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 10px;
            margin: 5px;
            white-space: nowrap;
        }
        .btn-titan>i{
            cursor: pointer;
            margin-left: 10px;
        }
        .label-per{
            margin-right: 8px;
            width: 80px;
        }
        .input-per{
            max-width: 200px;
            width: 100%;
            height: 30px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        var titans = {};

        @foreach ($titans as $titan)
        titans['{{ $titan->id }}'] = {
           'id': parseInt({{ $titan->id }}),
           'name': '{{ $titan->name }}',
           'selected': 0,
           'vsa': 0,
           'sa': 0,
           'wa': 0,
           'vwa': 0
        };
        @endforeach

        @if ( isset($errorMsg) && strlen($errorMsg) )
        alert('{{ $errorMsg }}');
        @elseif ( isset($successMsg) && strlen($successMsg) )
        alert('{{ $successMsg }}');
        @endif

        function showModalVSA () {
            var _html = "<option value='0'>{{ ucfirst(__('titan.select_titan')) }}</option>";

            $('#addTitanVSAModalTitle').html('{{ strtoupper(__('general.very_strong_against')) }}');
            $.each(titans, function ( _key ) {
                if ( ! titans[_key].selected )
                    _html += "<option value='" + _key + "'>" + titans[_key].name + "</option>";
            });

            $('#addTitanVSAModalSelect').html(_html);
            $('#addTitanVSAModal').modal('show');
        }

        function showModalSA () {
            var _html = "<option value='0'>{{ ucfirst(__('titan.select_titan')) }}</option>";

            $('#addTitanSAModalTitle').html('{{ strtoupper(__('general.strong_against')) }}');
            $.each(titans, function ( _key ) {
                if ( ! titans[_key].selected )
                    _html += "<option value='" + _key + "'>" + titans[_key].name + "</option>";
            });

            $('#addTitanSAModalSelect').html(_html);
            $('#addTitanSAModal').modal('show');
        }

        function showModalVWA () {
            var _html = "<option value='0'>{{ ucfirst(__('titan.select_titan')) }}</option>";

            $('#addTitanVWAModalTitle').html('{{ strtoupper(__('general.very_weak_against')) }}');
            $.each(titans, function ( _key ) {
                if ( ! titans[_key].selected )
                    _html += "<option value='" + _key + "'>" + titans[_key].name + "</option>";
            });

            $('#addTitanVWAModalSelect').html(_html);
            $('#addTitanVWAModal').modal('show');
        }

        function showModalWA () {
            var _html = "<option value='0'>{{ ucfirst(__('titan.select_titan')) }}</option>";

            $('#addTitanWAModalTitle').html('{{ strtoupper(__('general.weak_against')) }}');
            $.each(titans, function ( _key ) {
                if ( ! titans[_key].selected )
                    _html += "<option value='" + _key + "'>" + titans[_key].name + "</option>";
            });

            $('#addTitanWAModalSelect').html(_html);
            $('#addTitanWAModal').modal('show');
        }

        function  addVSATitan() {
            let _titanId = parseInt($('#addTitanVSAModalSelect').val()),
                _html = addTitan(_titanId, 'vsa');

            if ( _html.length ) {
                titans[_titanId].vsa = 1;
                $('#titansVSA').append(_html);
                $('#addTitanVSAModal').modal('hide');
            }
        }

        function  addSATitan() {
            let _titanId = parseInt($('#addTitanSAModalSelect').val()),
                _html = addTitan(_titanId, 'sa');

            if ( _html.length ) {
                titans[_titanId].sa = 1;
                $('#titansSA').append(_html);
                $('#addTitanSAModal').modal('hide');
            }
        }

        function  addVWATitan() {
            let _titanId = parseInt($('#addTitanVWAModalSelect').val()),
                _html = addTitan(_titanId, 'vwa');

            if ( _html.length ) {
                titans[_titanId].vwa = 1;
                $('#titansVWA').append(_html);
                $('#addTitanVWAModal').modal('hide');
            }
        }

        function  addWATitan() {
            let _titanId = parseInt($('#addTitanWAModalSelect').val()),
                _html = addTitan(_titanId, 'wa');

            if ( _html.length ) {
                titans[_titanId].wa = 1;
                $('#titansWA').append(_html);
                $('#addTitanWAModal').modal('hide');
            }
        }

        function addTitan (_titanId, _type) {
            let _html = '';

            if ( _titanId <= 0 ) {
                alert('{{ ucfirst(__('titan.not_valid_titan')) }}');
            }
            else {
                titans[_titanId].selected = 1;

                _html += ""
                    + "<div class='btn-titan' id='choosedTitan_" + _titanId + "'>"
                    +     "<div class='d-none " + _type + "'>" + _titanId + "</div>"
                    +     titans[_titanId].name
                    +     "<i class='fas fa-times' onclick='freeTitan(" + _titanId + ")'></i>"
                    + "</div>";
            }

            return _html;
        }

        function freeTitan (_id) {
            $('#choosedTitan_' + _id).remove();
            titans[_id].selected = 0;
            titans[_id].vsa = 0;
            titans[_id].sa = 0;
            titans[_id].vwa = 0;
            titans[_id].wa = 0;
        }

        function store () {
            var _params = {},
                _vsa,
                _sa,
                _vwa,
                _wa,
                _name = $('#titanName').val().trim(),
                _element = parseInt($('#titanElement').val());

            if ( _name.length < 2 ) {
                alert('{{ ucfirst(__('general.name_min_length_two')) }}');
                return;
            }

            let _error = false;
            $.each(titans, function ( _key, _titan ) {
                if ( _titan.name.toUpperCase() === _name.toUpperCase() ) {
                    _error = true;
                    return false;
                }
            });

            if ( _error ) {
                alert('{{ ucfirst(__('titan.exist_titan_with_same_name')) }}');
                return;
            }

            _vsa = [];
            _sa = [];
            _vwa = [];
            _wa = [];

            $.each($('.vsa'), function (_key, _divVSA) { _vsa.push(parseInt(_divVSA.innerHTML)); });
            $.each($('.sa'), function (_key, _divSA) { _sa.push(parseInt(_divSA.innerHTML)); });
            $.each($('.vwa'), function (_key, _divVWA) { _vwa.push(parseInt(_divVWA.innerHTML)); });
            $.each($('.wa'), function (_key, _divWA) { _wa.push(parseInt(_divWA.innerHTML)); });

            _params = {
                '_token': '{{ csrf_token() }}',
                'vsa': _vsa,
                'sa': _sa,
                'vwa': _vwa,
                'wa': _wa,
                'name': _name,
                'element': _element
            };

            $.post('{{ route('titan.store') }}', _params, function (_data) {
                alert(_data.msg);

                if ( ! _data.err )
                    window.location.href = '{{ route('titans') }}';
            });
        }
    </script>
@endsection