@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('hero.edit_hero')) }}</h2>
            </div>
            <div class="col-12 mb-3 d-flex justify-content-center align-items-baseline flex-wrap">
                <Label class="label-name" for="heroName">{{ ucfirst(__('general.name')) }}:</Label>
                <input type="text" class="input-name" id="heroName" value="{{ $hero->name }}">
            </div>
            <div class="col-12 container-heroes">
                <h4 class="text-center">{{ ucfirst(__('general.very_strong_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="heroesVSA">
                    @foreach($hero->vsa as $heroVSA)
                        <div class='btn-hero' id='choosedHero_{{ $heroVSA->id }}'>
                            <div class='d-none vsa'>{{ $heroVSA->id }}</div>
                            {{ $heroVSA->name }}
                            <i class='fas fa-times' onclick='freeHero({{ $heroVSA->id }})'></i>
                        </div>
                    @endforeach
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalVSA()">{{ __('hero.add_hero') }}</div>
                </div>
            </div>
            <div class="col-12 container-heroes">
                <h4 class="text-center">{{ ucfirst(__('general.strong_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="heroesSA">
                    @foreach($hero->sa as $heroSA)
                        <div class='btn-hero' id='choosedHero_{{ $heroSA->id }}'>
                            <div class='d-none sa'>{{ $heroSA->id }}</div>
                            {{ $heroSA->name }}
                            <i class='fas fa-times' onclick='freeHero({{ $heroSA->id }})'></i>
                        </div>
                    @endforeach
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalSA()">{{ __('hero.add_hero') }}</div>
                </div>
            </div>
            <div class="col-12 container-heroes">
                <h4 class="text-center">{{ ucfirst(__('general.very_weak_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="heroesVWA">
                    @foreach($hero->vwa as $heroVWA)
                        <div class='btn-hero' id='choosedHero_{{ $heroVWA->id }}'>
                            <div class='d-none vwa'>{{ $heroVWA->id }}</div>
                            {{ $heroVWA->name }}
                            <i class='fas fa-times' onclick='freeHero({{ $heroVWA->id }})'></i>
                        </div>
                    @endforeach
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalVWA()">{{ __('hero.add_hero') }}</div>
                </div>
            </div>
            <div class="col-12 container-heroes">
                <h4 class="text-center">{{ ucfirst(__('general.weak_against')) }}</h4>
                <div class="d-flex justify-content-center flex-wrap mb-2" id="heroesWA">
                    @foreach($hero->wa as $heroWA)
                        <div class='btn-hero' id='choosedHero_{{ $heroWA->id }}'>
                            <div class='d-none wa'>{{ $heroWA->id }}</div>
                            {{ $heroWA->name }}
                            <i class='fas fa-times' onclick='freeHero({{ $heroWA->id }})'></i>
                        </div>
                    @endforeach
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <div class="btn btn-primary" onclick="showModalWA()">{{ __('hero.add_hero') }}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <a class="btn btn-warning m-1" href="{{ route('heroes') }}">{{ strtoupper(__('general.back')) }}</a>
                <div class="btn btn-success m-1" onclick="update()">{{ strtoupper(__('general.save_changes')) }}</div>
            </div>
        </div>
    </div>

    {{-- ADD HERO VSA MODAL --}}
    <div class="modal fade" id="addHeroVSAModal" tabindex="-1" role="dialog" aria-labelledby="addHeroVSAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHeroVSAModalTitle">{{ strtoupper(__('general.very_strong_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addHeroVSAModalSelect">{{ __('hero.add_hero') }}</label>
                        <select class="form-control" id="addHeroVSAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addVSAHero()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD HERO SA MODAL --}}
    <div class="modal fade" id="addHeroSAModal" tabindex="-1" role="dialog" aria-labelledby="addHeroSAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHeroSAModalTitle">{{ strtoupper(__('general.strong_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addHeroSAModalSelect">{{ __('hero.add_hero') }}</label>
                        <select class="form-control" id="addHeroSAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addSAHero()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD HERO VWA MODAL --}}
    <div class="modal fade" id="addHeroVWAModal" tabindex="-1" role="dialog" aria-labelledby="addHeroVWAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHeroVWAModalTitle">{{ strtoupper(__('general.very_weak_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addHeroVWAModalSelect">{{ __('hero.add_hero') }}</label>
                        <select class="form-control" id="addHeroVWAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addVWAHero()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD HERO WA MODAL --}}
    <div class="modal fade" id="addHeroWAModal" tabindex="-1" role="dialog" aria-labelledby="addHeroWAModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHeroWAModalTitle">{{ strtoupper(__('general.weak_against')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addHeroWAModalSelect">{{ __('hero.add_hero') }}</label>
                        <select class="form-control" id="addHeroWAModalSelect"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                    <button type="button" class="btn btn-primary" onclick="addWAHero()">{{ ucfirst(__('general.add')) }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <style>
        .container-heroes{
            border: 1px solid #007bff;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .btn-hero{
            background-color: #004080;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 10px;
            margin: 5px;
            white-space: nowrap;
        }
        .btn-hero>i{
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
        var heroes = {};

        @foreach ($heroes as $heroAux)
        heroes['{{ $heroAux->id }}'] = {
           'id': parseInt({{ $heroAux->id }}),
           'name': '{{ $heroAux->name }}',
           'selected': 0,
           'vsa': 0,
           'sa': 0,
           'wa': 0,
           'vwa': 0
        };
        @endforeach

        @foreach($hero->vsa as $heroVSA)
            heroes['{{ $heroVSA->id }}'].selected = heroes['{{ $heroVSA->id }}'].vsa = 1;
        @endforeach

        @foreach($hero->sa as $heroSA)
            heroes['{{ $heroSA->id }}'].selected = heroes['{{ $heroSA->id }}'].sa = 1;
        @endforeach

        @foreach($hero->vwa as $heroVWA)
            heroes['{{ $heroVWA->id }}'].selected = heroes['{{ $heroVWA->id }}'].vwa = 1;
        @endforeach

        @foreach($hero->wa as $heroWA)
            heroes['{{ $heroWA->id }}'].selected = heroes['{{ $heroWA->id }}'].wa = 1;
        @endforeach

        @if ( isset($errorMsg) && strlen($errorMsg) )
        alert('{{ $errorMsg }}');
        @elseif ( isset($successMsg) && strlen($successMsg) )
        alert('{{ $successMsg }}');
        @endif

        function showModalVSA () {
            var _html = "<option value='0'>{{ ucfirst(__('hero.select_hero')) }}</option>";

            $('#addHeroVSAModalTitle').html('{{ strtoupper(__('general.very_strong_against')) }}');
            $.each(heroes, function ( _key ) {
                if ( ! heroes[_key].selected )
                    _html += "<option value='" + _key + "'>" + heroes[_key].name + "</option>";
            });

            $('#addHeroVSAModalSelect').html(_html);
            $('#addHeroVSAModal').modal('show');
        }

        function showModalSA () {
            var _html = "<option value='0'>{{ ucfirst(__('hero.select_hero')) }}</option>";

            $('#addHeroSAModalTitle').html('{{ strtoupper(__('general.strong_against')) }}');
            $.each(heroes, function ( _key ) {
                if ( ! heroes[_key].selected )
                    _html += "<option value='" + _key + "'>" + heroes[_key].name + "</option>";
            });

            $('#addHeroSAModalSelect').html(_html);
            $('#addHeroSAModal').modal('show');
        }

        function showModalVWA () {
            var _html = "<option value='0'>{{ ucfirst(__('hero.select_hero')) }}</option>";

            $('#addHeroVWAModalTitle').html('{{ strtoupper(__('general.very_weak_against')) }}');
            $.each(heroes, function ( _key ) {
                if ( ! heroes[_key].selected )
                    _html += "<option value='" + _key + "'>" + heroes[_key].name + "</option>";
            });

            $('#addHeroVWAModalSelect').html(_html);
            $('#addHeroVWAModal').modal('show');
        }

        function showModalWA () {
            var _html = "<option value='0'>{{ ucfirst(__('hero.select_hero')) }}</option>";

            $('#addHeroWAModalTitle').html('{{ strtoupper(__('general.weak_against')) }}');
            $.each(heroes, function ( _key ) {
                if ( ! heroes[_key].selected )
                    _html += "<option value='" + _key + "'>" + heroes[_key].name + "</option>";
            });

            $('#addHeroWAModalSelect').html(_html);
            $('#addHeroWAModal').modal('show');
        }

        function  addVSAHero() {
            let _heroId = parseInt($('#addHeroVSAModalSelect').val()),
                _html = addHero(_heroId, 'vsa');

            if ( _html.length ) {
                heroes[_heroId].vsa = 1;
                $('#heroesVSA').append(_html);
                $('#addHeroVSAModal').modal('hide');
            }
        }

        function  addSAHero() {
            let _heroId = parseInt($('#addHeroSAModalSelect').val()),
                _html = addHero(_heroId, 'sa');

            if ( _html.length ) {
                heroes[_heroId].sa = 1;
                $('#heroesSA').append(_html);
                $('#addHeroSAModal').modal('hide');
            }
        }

        function  addVWAHero() {
            let _heroId = parseInt($('#addHeroVWAModalSelect').val()),
                _html = addHero(_heroId, 'vwa');

            if ( _html.length ) {
                heroes[_heroId].vwa = 1;
                $('#heroesVWA').append(_html);
                $('#addHeroVWAModal').modal('hide');
            }
        }

        function  addWAHero() {
            let _heroId = parseInt($('#addHeroWAModalSelect').val()),
                _html = addHero(_heroId, 'wa');

            if ( _html.length ) {
                heroes[_heroId].wa = 1;
                $('#heroesWA').append(_html);
                $('#addHeroWAModal').modal('hide');
            }
        }

        function addHero (_heroId, _type) {
            let _html = '';

            if ( _heroId <= 0 ) {
                alert('{{ ucfirst(__('hero.not_valid_hero')) }}');
            }
            else {
                heroes[_heroId].selected = 1;

                _html += ""
                    + "<div class='btn-hero' id='choosedHero_" + _heroId + "'>"
                    +     "<div class='d-none " + _type + "'>" + _heroId + "</div>"
                    +     heroes[_heroId].name
                    +     "<i class='fas fa-times' onclick='freeHero(" + _heroId + ")'></i>"
                    + "</div>";
            }

            return _html;
        }

        function freeHero (_id) {
            $('#choosedHero_' + _id).remove();
            heroes[_id].selected = 0;
            heroes[_id].vsa = 0;
            heroes[_id].sa = 0;
            heroes[_id].vwa = 0;
            heroes[_id].wa = 0;
        }

        function update () {
            if ( ! confirm('{{ ucfirst(__('general.confirm_to_update')) }}') )
                return;

            var _params = {},
                _vsa,
                _sa,
                _vwa,
                _wa,
                _name = $('#heroName').val().trim();

            if ( _name.length < 2 ) {
                alert('{{ ucfirst(__('general.name_min_length_two')) }}');
                return;
            }

            let _error = false;
            $.each(heroes, function ( _key, _hero ) {
                if ( _hero.name.toUpperCase() === _name.toUpperCase() ) {
                    _error = true;
                    return false;
                }
            });

            if ( _error ) {
                alert('{{ ucfirst(__('hero.exist_hero_with_same_name')) }}');
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

            $.post('{{ route('hero.update', $hero->id) }}', _params, function (_data) {
                if ( _data.err ) {
                    alert(_data.msg);
                }
                else {
                    window.location.reload()
                }
            });
        }
    </script>
@endsection