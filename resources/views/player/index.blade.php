@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('player.list_title')) }}</h2>
            </div>

            <div class="col-12 d-flex justify-content-center mb-3">
                <div class="btn btn-success m-1" data-toggle="modal" data-target="#createPlayerModal">{{ __('player.add_new_player') }}</div>
            </div>

            <div class="col-12">
                <table id="players_table" class="display">
                    <thead>
                    <tr>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                        <th>{{ strtoupper(__('table.name')) }}</th>
                        <th>{{ strtoupper(__('general.guild')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($players as $player)
                        <tr>
                            <td>
                                <div class="btn btn-sm btn-primary" onclick="renamePlayer({{ $player->id }}, '{{ $player->name }}')">{{ __('general.rename') }}</div>
                                <div class="btn btn-sm btn-danger" onclick="deletePlayer({{ $player->id }})">{{ __('general.delete') }}</div>
                                <div class="d-none">
                                    <form id="deletePlayerForm_{{ $player->id }}" action="{{ route('player.delete', $player->id) }}" method="post">@csrf</form>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('player', $player->id) }}">{{ $player->name }}</a>
                            </td>
                            <td>{{ $player->guilds->first()->name ?? '' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- RENAME PLAYER MODALS --}}
    <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renameModalTitle">{{ strtoupper(__('general.rename_player')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.update') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="playerId" id="playerId">
                        <div class="form-group">
                            <label for="previousName">{{ ucfirst(__('general.previousName')) }}</label>
                            <input type="text" class="form-control" id="previousName" disabled>
                        </div>
                        <div class="form-group">
                            <label for="currentName">{{ ucfirst( __('general.current_name')) }}</label>
                            <input type="text" class="form-control" id="currentName" name="currentName" required>
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

    {{-- CREATE PLAYER MODAL --}}
    <div class="modal fade" id="createPlayerModal" tabindex="-1" role="dialog" aria-labelledby="createPlayerModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPlayerModalTitle">{{ strtoupper(__('player.add_new_player')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('player.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="currentName">{{ ucfirst( __('general.name')) }}</label>
                            <input type="text" class="form-control" id="name" name="name" required>
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
            $('#players_table').DataTable({
                //'searching': false
            });
        } );

        function renamePlayer ( _playerId, _playerName ) {
            $('#previousName').val(_playerName);
            $('#playerId').val(_playerId);
            $('#renameModal').modal('show');
        }

        function deletePlayer (_playerId) {
            if ( confirm('{{ __('player.confirm_to_delete_player') }}') )
                $('#deletePlayerForm_' + _playerId).submit();
        }
    </script>
@endsection