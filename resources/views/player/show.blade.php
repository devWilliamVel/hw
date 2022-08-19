@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <h2 class="text-center font-weight-bold">{{ strtoupper(__('general.player')) . ': ' . $player->name }}</h2>
                @if ( isset($guild->id) )
                <h4 class="text-center">
                    {{ strtoupper(__('general.guild') . ': ') }}
                    <a href="{{ route('guild', $guild->id) }}">{{ $guild->name }}</a>
                </h4>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-5 container-section">
                <h4 class="text-center">{{ __('player.heroes_for_war') }}</h4>

                <table id="heroesTable" class="table table-striped table-bordered nowrap">
                    <thead class="dataTableHead">
                    <tr>
                        <th>{{ strtoupper(__('general.name')) }}</th>
                        <th>{{ strtoupper(__('general.level')) }}</th>
                        <th>{{ strtoupper(__('general.power')) }}</th>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $heroes as $hero )
                        <tr>
                            <td>{{ $hero->name }}</td>
                            <td>{{ $hero->level }}</td>
                            <td>{{ $hero->power }}</td>
                            <td>
                                <div class="btn btn-sm btn-primary" onclick="editHeroModalShow({{ $hero->id }}, '{{ $hero->name }}', {{ $hero->power }}, {{ $hero->level }})"><i class="fas fa-edit"></i></div>
                                <div class="btn btn-sm btn-danger" onclick="deleteHero({{ $hero->id }})"><i class="fas fa-trash-alt"></i></div>
                                <form class="d-none" id="deleteHeroForm_{{ $hero->id }}" action="{{ route('player.remove.hero', [$player->id, $hero->id]) }}" method="post">@csrf</form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary" data-toggle="modal" data-target="#addHeroModal">{{ __('hero.add') }}</div>
                </div>
            </div>

            <div class="col-12 mb-5 container-section">
                <h4 class="text-center">{{ __('player.titans_for_war') }}</h4>

                <table id="titansTable" class="table table-striped table-bordered nowrap w-100">
                    <thead class="dataTableHead">
                    <tr>
                        <th>{{ strtoupper(__('general.name')) }}</th>
                        <th>{{ strtoupper(__('general.element')) }}</th>
                        <th>{{ strtoupper(__('general.level')) }}</th>
                        <th>{{ strtoupper(__('general.power')) }}</th>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $titans as $titan )
                        <tr>
                            <td>{{ $titan->name }}</td>
                            <td>{{ $titan->element }}</td>
                            <td>{{ $titan->level }}</td>
                            <td>{{ $titan->power }}</td>
                            <td>
                                <div class="btn btn-sm btn-primary" onclick="editTitanModalShow({{ $titan->id }}, '{{ $titan->name }}', {{ $titan->power }}, {{ $titan->level }})"><i class="fas fa-edit"></i></div>
                                <div class="btn btn-sm btn-danger" onclick="deleteTitan({{ $titan->id }})"><i class="fas fa-trash-alt"></i></div>
                                <form class="d-none" id="deleteTitanForm_{{ $titan->id }}" action="{{ route('player.remove.titan', [$player->id, $titan->id]) }}" method="post">@csrf</form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary" data-toggle="modal" data-target="#addTitanModal">{{ __('titan.add') }}</div>
                </div>
            </div>

            <div class="col-12 mb-5 container-section">
                <h4 class="text-center">{{ __('player.pets_for_war') }}</h4>

                <table id="petsTable" class="table table-striped table-bordered nowrap w-100">
                    <thead class="dataTableHead">
                    <tr>
                        <th>{{ strtoupper(__('general.name')) }}</th>
                        <th>{{ strtoupper(__('general.level')) }}</th>
                        <th>{{ strtoupper(__('general.power')) }}</th>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ( $pets as $pet )
                        <tr>
                            <td>{{ $pet->name }}</td>
                            <td>{{ $pet->level }}</td>
                            <td>{{ $pet->power }}</td>
                            <td>
                                <div class="btn btn-sm btn-primary" onclick="editPetModalShow({{ $pet->id }}, '{{ $pet->name }}', {{ $pet->power }}, {{ $pet->level }})"><i class="fas fa-edit"></i></div>
                                <div class="btn btn-sm btn-danger" onclick="deletePet({{ $pet->id }})"><i class="fas fa-trash-alt"></i></div>
                                <form class="d-none" id="deletePetForm_{{ $pet->id }}" action="{{ route('player.remove.pet', [$player->id, $pet->id]) }}" method="post">@csrf</form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    <div class="btn btn-primary" data-toggle="modal" data-target="#addPetModal">{{ __('pet.add') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD HERO MODAL --}}
    <div class="modal fade" id="addHeroModal" tabindex="-1" role="dialog" aria-labelledby="addHeroModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addHeroModalTitle">{{ strtoupper(__('player.add_hero')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.add.hero', $player->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="addHeroId">{{ ucfirst( __('hero.select_hero')) }}</label>
                            <select class="form-control" id="addHeroId" name="addHeroId" required>
                                <option value="">{{ __('general.choose_option') }}</option>
                                @foreach( $missingHeroes as $hero )
                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newHeroLevel">{{ ucfirst( __('general.level')) }}</label>
                            <input type="number" class="form-control" id="newHeroLevel" name="newHeroLevel" required>
                        </div>
                        <div class="form-group">
                            <label for="newHeroPower">{{ ucfirst( __('general.power')) }}</label>
                            <input type="number" class="form-control" id="newHeroPower" name="newHeroPower" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                        <button type="submit" class="btn btn-primary">{{ ucfirst(__('general.save')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- EDIT HERO MODAL --}}
    <div class="modal fade" id="editHeroModal" tabindex="-1" role="dialog" aria-labelledby="editHeroModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editHeroModalTitle">{{ strtoupper(__('player.edit_hero')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.update.hero', $player->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="editHeroId" name="editHeroId">
                        <div class="form-group">
                            <label for="editHeroName">{{ ucfirst( __('general.name')) }}</label>
                            <input type="text" class="form-control" id="editHeroName" disabled>
                        </div>
                        <div class="form-group">
                            <label for="editHeroLevel">{{ ucfirst( __('general.level')) }}</label>
                            <input type="number" class="form-control" id="editHeroLevel" name="editHeroLevel" required>
                        </div>
                        <div class="form-group">
                            <label for="editHeroPower">{{ ucfirst( __('general.power')) }}</label>
                            <input type="number" class="form-control" id="editHeroPower" name="editHeroPower" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                        <button type="submit" class="btn btn-primary">{{ ucfirst(__('general.update')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ADD TITAN MODAL --}}
    <div class="modal fade" id="addTitanModal" tabindex="-1" role="dialog" aria-labelledby="addTitanModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTitanModalTitle">{{ strtoupper(__('player.add_titan')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.add.titan', $player->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="addTitanId">{{ ucfirst( __('titan.select_titan')) }}</label>
                            <select class="form-control" id="addTitanId" name="addTitanId" required>
                                <option value="">{{ __('general.choose_option') }}</option>
                                @foreach( $missingTitans as $titan )
                                    <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newTitanLevel">{{ ucfirst( __('general.level')) }}</label>
                            <input type="number" class="form-control" id="newTitanLevel" name="newTitanLevel" required>
                        </div>
                        <div class="form-group">
                            <label for="newTitanPower">{{ ucfirst( __('general.power')) }}</label>
                            <input type="number" class="form-control" id="newTitanPower" name="newTitanPower" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                        <button type="submit" class="btn btn-primary">{{ ucfirst(__('general.save')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- EDIT TITAN MODAL --}}
    <div class="modal fade" id="editTitanModal" tabindex="-1" role="dialog" aria-labelledby="editTitanModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTitanModalTitle">{{ strtoupper(__('player.edit_hero')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.update.titan', $player->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="editTitanId" name="editTitanId">
                        <div class="form-group">
                            <label for="editTitanName">{{ ucfirst( __('general.name')) }}</label>
                            <input type="text" class="form-control" id="editTitanName" disabled>
                        </div>
                        <div class="form-group">
                            <label for="editTitanLevel">{{ ucfirst( __('general.level')) }}</label>
                            <input type="number" class="form-control" id="editTitanLevel" name="editTitanLevel" required>
                        </div>
                        <div class="form-group">
                            <label for="editTitanPower">{{ ucfirst( __('general.power')) }}</label>
                            <input type="number" class="form-control" id="editTitanPower" name="editTitanPower" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                        <button type="submit" class="btn btn-primary">{{ ucfirst(__('general.update')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ADD PET MODAL --}}
    <div class="modal fade" id="addPetModal" tabindex="-1" role="dialog" aria-labelledby="addPetModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPetModalTitle">{{ strtoupper(__('player.add_pet')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.add.pet', $player->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="addPetId">{{ ucfirst( __('hero.select_hero')) }}</label>
                            <select class="form-control" id="addPetId" name="addPetId" required>
                                <option value="">{{ __('general.choose_option') }}</option>
                                @foreach( $missingPets as $pet )
                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="newPetLevel">{{ ucfirst( __('general.level')) }}</label>
                            <input type="number" class="form-control" id="newPetLevel" name="newPetLevel" required>
                        </div>
                        <div class="form-group">
                            <label for="newPetPower">{{ ucfirst( __('general.power')) }}</label>
                            <input type="number" class="form-control" id="newPetPower" name="newPetPower" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                        <button type="submit" class="btn btn-primary">{{ ucfirst(__('general.save')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- EDIT PET MODAL --}}
    <div class="modal fade" id="editPetModal" tabindex="-1" role="dialog" aria-labelledby="editPetModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPetModalTitle">{{ strtoupper(__('player.edit_pet')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.update.pet', $player->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="editPetId" name="editPetId">
                        <div class="form-group">
                            <label for="editPetName">{{ ucfirst( __('general.name')) }}</label>
                            <input type="text" class="form-control" id="editPetName" disabled>
                        </div>
                        <div class="form-group">
                            <label for="editPetLevel">{{ ucfirst( __('general.level')) }}</label>
                            <input type="number" class="form-control" id="editPetLevel" name="editPetLevel" required>
                        </div>
                        <div class="form-group">
                            <label for="editPetPower">{{ ucfirst( __('general.power')) }}</label>
                            <input type="number" class="form-control" id="editPetPower" name="editPetPower" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ ucfirst(__('general.close')) }}</button>
                        <button type="submit" class="btn btn-primary">{{ ucfirst(__('general.update')) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">--}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <style>
        .dataTableHead {
            background-color: #004080;
            color: #fff;
        }
        .container-section{
            border: 1px solid #004080;
            padding: 20px;
            background-color: #ffffff;
        }
    </style>
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#heroesTable').DataTable({
                'searching': false
            });
            $('#heroesTable').parent().css({'overflow-x':'scroll'});
        } );
        $(document).ready( function () {
            $('#titansTable').DataTable({
                'searching': false
            });
            $('#titansTable').parent().css({'overflow-x':'scroll'});
        } );
        $(document).ready( function () {
            $('#petsTable').DataTable({
                'searching': false
            });
            $('#petsTable').parent().css({'overflow-x':'scroll'});
        } );

        function deleteHero ( _heroId ) {
            if ( confirm('{{ __('hero.confirm_to_delete') }}') )
                $('#deleteHeroForm_' + _heroId).submit();
        }

        function deleteTitan ( _titanId ) {
            if ( confirm('{{ __('titan.confirm_to_delete') }}') )
                $('#deleteTitanForm_' + _titanId).submit();
        }

        function deletePet ( _petId ) {
            if ( confirm('{{ __('pet.confirm_to_delete') }}') )
                $('#deletePetForm_' + _petId).submit();
        }

        function editHeroModalShow ( _heroId, _heroName, _oldPower, _oldLevel ) {
            $('#editHeroId').val(_heroId);
            $('#editHeroName').val(_heroName);
            $('#editHeroPower').val(_oldPower);
            $('#editHeroLevel').val(_oldLevel);

            $('#editHeroModal').modal('show');
        }

        function editTitanModalShow ( _titanId, _titanName, _oldPower, _oldLevel ) {
            $('#editTitanId').val(_titanId);
            $('#editTitanName').val(_titanName);
            $('#editTitanPower').val(_oldPower);
            $('#editTitanLevel').val(_oldLevel);

            $('#editTitanModal').modal('show');
        }

        function editPetModalShow ( _petId, _petName, _oldPower, _oldLevel ) {
            $('#editPetId').val(_petId);
            $('#editPetName').val(_petName);
            $('#editPetPower').val(_oldPower);
            $('#editPetLevel').val(_oldLevel);

            $('#editPetModal').modal('show');
        }
    </script>
@endsection