@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-3">{{ strtoupper(__('general.guild') . ' "' . $guild->name . '"') }}</h2>
            </div>

            <div class="col-12 d-flex justify-content-center mb-3">
                <div class="btn btn-primary m-1">{{ __('guild.add_exist_player') }}</div>
                <div class="btn btn-success m-1">{{ __('guild.add_new_player') }}</div>
            </div>

            <div class="col-12">
                <table id="table_id" class="display">
                    <thead>
                    <tr>
                        <th>{{ strtoupper(__('table.actions')) }}</th>
                        <th>{{ strtoupper(__('table.name')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    <div class="btn btn-sm btn-danger" onclick="expulsar({{ $member->id }})">{{ __('general.expel') }}</div>
                                </td>
                                <td>
                                    <a href="{{ route('player', $member->id) }}">{{ $member->name }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- CREATE GUILD MODAL --}}
    {{--<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalTitle" aria-hidden="true">
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
    </div>--}}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@endsection

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                //'searching': false
            });
        } );

        function expulsar ( _userId ) {

        }
    </script>
@endsection