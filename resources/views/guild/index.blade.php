@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('guild.list_title')) }}</h2>
            </div>

            <div class="col-12 d-flex justify-content-center mb-3">
                <div class="btn btn-success m-1" data-toggle="modal" data-target="#createGuildModal">{{ __('guild.create_guild') }}</div>
            </div>
            <div class="col-12">
                <table id="guilds_table" class="display w-100">
                    <thead>
                    <tr>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                        <th>{{ strtoupper(__('table.name')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guilds as $guild)
                        <tr>
                            <td>
                                <div class="btn btn-sm btn-primary" onclick="renameGuild({{ $guild->id }}, '{{ $guild->name }}')">{{ __('general.rename') }}</div>
                                <div class="btn btn-sm btn-danger" onclick="deleteGuild({{ $guild->id }})">{{ __('general.delete') }}</div>
                                <div class="d-none">
                                    <form id="deleteGuildForm_{{ $guild->id }}" action="{{ route('guild.delete', $guild->id) }}" method="post">@csrf</form>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('guild', $guild->id) }}">{{ $guild->name }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- RENAME GUILD MODAL --}}
    <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="renameModalTitle">{{ strtoupper(__('general.rename') . " " . __('general.guild')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('guild.update') }}" method="post">
                    <div class="modal-body">
                            @csrf
                            <input type="hidden" name="guildId" id="guildId">
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

    {{-- CREATE GUILD MODAL --}}
    <div class="modal fade" id="createGuildModal" tabindex="-1" role="dialog" aria-labelledby="createGuildModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGuildModalTitle">{{ strtoupper(__('guild.create_guild')) }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('guild.store') }}" method="post">
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
            $('#guilds_table').DataTable({
                searching: true,
                scrollX: true,
                language: datatable_translation
            });
        } );

        function renameGuild ( _guildId, _guildName ) {
            $('#previousName').val(_guildName);
            $('#guildId').val(_guildId);
            $('#renameModal').modal('show');
        }

        function deleteGuild (_guildId) {
            if ( confirm('{{ __('guild.confirm_to_delete_guild') }}') )
                $('#deleteGuildForm_' + _guildId).submit();
        }
    </script>
@endsection