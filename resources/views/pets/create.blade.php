@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('pet.create_pet')) }}</h2>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center align-items-baseline flex-wrap">
                <Label class="label-name" for="petName">{{ ucfirst(__('general.name')) }}:</Label>
                <input type="text" class="input-name" id="petName">
            </div>
            <div class="col-12 container-pets">
                <h4 class="text-center">{{ ucfirst(__('general.very_strong_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="petsVSA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalVSA()">{{ __('pet.add_pet') }}</div>
                </div>
            </div>
            <div class="col-12 container-pets">
                <h4 class="text-center">{{ ucfirst(__('general.strong_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="petsSA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalSA()">{{ __('pet.add_pet') }}</div>
                </div>
            </div>
            <div class="col-12 container-pets">
                <h4 class="text-center">{{ ucfirst(__('general.very_weak_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="petsVWA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalVWA()">{{ __('pet.add_pet') }}</div>
                </div>
            </div>
            <div class="col-12 container-pets">
                <h4 class="text-center">{{ ucfirst(__('general.weak_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="petsWA"></div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalWA()">{{ __('pet.add_pet') }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="btn btn-warning m-1" href="{{ route('pets') }}">{{ strtoupper(__('general.back')) }}</a>
                <div class="btn btn-success m-1" onclick="store()">{{ strtoupper(__('pet.create_pet')) }}</div>
            </div>
        </div>
    </div>

    {{-- ADD PET VSA MODAL --}}
    <div class="modal fade" id="addPetVSAModal" tabindex="-1" role="dialog" aria-labelledby="addPetVSAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetVSAModalTitle">{{ strtoupper(__('general.very_strong_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addPetVSAModalSelect">{{ __('pet.add_pet') }}</label>
                        <select class="form-control" id="addPetVSAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addVSAPet()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD PET SA MODAL --}}
    <div class="modal fade" id="addPetSAModal" tabindex="-1" role="dialog" aria-labelledby="addPetSAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetSAModalTitle">{{ strtoupper(__('general.strong_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addPetSAModalSelect">{{ __('pet.add_pet') }}</label>
                        <select class="form-control" id="addPetSAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addSAPet()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD PET VWA MODAL --}}
    <div class="modal fade" id="addPetVWAModal" tabindex="-1" role="dialog" aria-labelledby="addPetVWAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetVWAModalTitle">{{ strtoupper(__('general.very_weak_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addPetVWAModalSelect">{{ __('pet.add_pet') }}</label>
                        <select class="form-control" id="addPetVWAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addVWAPet()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD PET WA MODAL --}}
    <div class="modal fade" id="addPetWAModal" tabindex="-1" role="dialog" aria-labelledby="addPetWAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetWAModalTitle">{{ strtoupper(__('general.weak_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addPetWAModalSelect">{{ __('pet.add_pet') }}</label>
                        <select class="form-control" id="addPetWAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addWAPet()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
        .container-pets{
            border: 1px solid #007bff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-pet{
            background-color: #004080;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 10px;
            margin: 5px;
            white-space: nowrap;
        }
        .btn-pet>i{
            cursor: pointer;
            margin-left: 10px;
        }
        .label-name{
            margin-right: 8px;
            width: 70px;
        }
        .input-name{
            max-width: 200px;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        var pets = {};

        @foreach ($pets as $pet)
        pets['{{ $pet->id }}'] = {
           'id': parseInt({{ $pet->id }}),
           'name': '{{ $pet->name }}',
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
            var _html = "<option value='0'>{{ ucfirst(__('pet.select_pet')) }}</option>";

            $('#addPetVSAModalTitle').html('{{ strtoupper(__('general.very_strong_against')) }}');
            $.each(pets, function ( _key ) {
                if ( ! pets[_key].selected )
                    _html += "<option value='" + _key + "'>" + pets[_key].name + "</option>";
            });

            $('#addPetVSAModalSelect').html(_html);
            $('#addPetVSAModal').modal('show');
        }

        function showModalSA () {
            var _html = "<option value='0'>{{ ucfirst(__('pet.select_pet')) }}</option>";

            $('#addPetSAModalTitle').html('{{ strtoupper(__('general.strong_against')) }}');
            $.each(pets, function ( _key ) {
                if ( ! pets[_key].selected )
                    _html += "<option value='" + _key + "'>" + pets[_key].name + "</option>";
            });

            $('#addPetSAModalSelect').html(_html);
            $('#addPetSAModal').modal('show');
        }

        function showModalVWA () {
            var _html = "<option value='0'>{{ ucfirst(__('pet.select_pet')) }}</option>";

            $('#addPetVWAModalTitle').html('{{ strtoupper(__('general.very_weak_against')) }}');
            $.each(pets, function ( _key ) {
                if ( ! pets[_key].selected )
                    _html += "<option value='" + _key + "'>" + pets[_key].name + "</option>";
            });

            $('#addPetVWAModalSelect').html(_html);
            $('#addPetVWAModal').modal('show');
        }

        function showModalWA () {
            var _html = "<option value='0'>{{ ucfirst(__('pet.select_pet')) }}</option>";

            $('#addPetWAModalTitle').html('{{ strtoupper(__('general.weak_against')) }}');
            $.each(pets, function ( _key ) {
                if ( ! pets[_key].selected )
                    _html += "<option value='" + _key + "'>" + pets[_key].name + "</option>";
            });

            $('#addPetWAModalSelect').html(_html);
            $('#addPetWAModal').modal('show');
        }

        function  addVSAPet() {
            let _petId = parseInt($('#addPetVSAModalSelect').val()),
                _html = addPet(_petId, 'vsa');

            if ( _html.length ) {
                pets[_petId].vsa = 1;
                $('#petsVSA').append(_html);
                $('#addPetVSAModal').modal('hide');
            }
        }

        function  addSAPet() {
            let _petId = parseInt($('#addPetSAModalSelect').val()),
                _html = addPet(_petId, 'sa');

            if ( _html.length ) {
                pets[_petId].sa = 1;
                $('#petsSA').append(_html);
                $('#addPetSAModal').modal('hide');
            }
        }

        function  addVWAPet() {
            let _petId = parseInt($('#addPetVWAModalSelect').val()),
                _html = addPet(_petId, 'vwa');

            if ( _html.length ) {
                pets[_petId].vwa = 1;
                $('#petsVWA').append(_html);
                $('#addPetVWAModal').modal('hide');
            }
        }

        function  addWAPet() {
            let _petId = parseInt($('#addPetWAModalSelect').val()),
                _html = addPet(_petId, 'wa');

            if ( _html.length ) {
                pets[_petId].wa = 1;
                $('#petsWA').append(_html);
                $('#addPetWAModal').modal('hide');
            }
        }

        function addPet (_petId, _type) {
            let _html = '';

            if ( _petId <= 0 ) {
                alert('{{ ucfirst(__('pet.not_valid_pet')) }}');
            }
            else {
                pets[_petId].selected = 1;

                _html += ""
                    + "<div class='btn-pet' id='choosedPet_" + _petId + "'>"
                    +     "<div class='d-none " + _type + "'>" + _petId + "</div>"
                    +     pets[_petId].name
                    +     "<i class='fas fa-times' onclick='freePet(" + _petId + ")'></i>"
                    + "</div>";
            }

            return _html;
        }

        function freePet (_id) {
            $('#choosedPet_' + _id).remove();
            pets[_id].selected = 0;
            pets[_id].vsa = 0;
            pets[_id].sa = 0;
            pets[_id].vwa = 0;
            pets[_id].wa = 0;
        }

        function store () {
            var _params = {},
                _vsa,
                _sa,
                _vwa,
                _wa,
                _name = $('#petName').val().trim();

            if ( _name.length < 2 ) {
                alert('{{ ucfirst(__('general.name_min_length_two')) }}');
                return;
            }

            let _error = false;
            $.each(pets, function ( _key, _pet ) {
                if ( _pet.name.toUpperCase() === _name.toUpperCase() ) {
                    _error = true;
                    return false;
                }
            });

            if ( _error ) {
                alert('{{ ucfirst(__('pet.exist_pet_with_same_name')) }}');
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
                'name': _name
            };

            $.post('{{ route('pet.store') }}', _params, function (_data) {
                alert(_data.msg);

                if ( ! _data.err )
                    window.location.href = '{{ route('pets') }}';
            });
        }
    </script>
@endsection