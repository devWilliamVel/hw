@extends('adminlte::page')

@section('content')
<div class="container">
    <h2 class="text-center mb-2">{{ strtoupper(__('combat.titans_combat')) }}</h2>
    <div class="row mb-3 card-container">
        <div class="col-12">
            <h4 class="">{{ strtoupper(__('combat.max_power')) }}</h4>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center">
            <div class="btn btn-primary m-1" data-toggle="modal" data-target="#addCombatModal">{{ ucfirst(__('combat.add_combat')) }}</div>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center">
            <div class="btn btn-warning m-1">{{ ucfirst(__('combat.best_team_vs')) }}</div>
        </div>
    </div>
    <div class="row mb-3 card-container">
        <div class="col-12">
            <h4>{{ strtoupper(__('combat.personalized_power')) }}</h4>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center">
            <div class="btn btn-primary m-1" data-toggle="modal" data-target="#addCombatWithPowerModal">{{ ucfirst(__('combat.add_combat')) }}</div>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center">
            <div class="btn btn-warning m-1">{{ ucfirst(__('combat.best_team_vs')) }}</div>
        </div>
    </div>
    <div class="row mb-3 card-container">
        <div class="col-12">
            <h4>{{ strtoupper(__('combat.full_information')) }}</h4>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center">
            <div class="btn btn-primary m-1" data-toggle="modal" data-target="#addCombatFullInformationModal">{{ ucfirst(__('combat.add_combat')) }}</div>
        </div>
        <div class="col-12 col-sm-6 d-flex justify-content-center">
            <div class="btn btn-warning m-1">{{ ucfirst(__('combat.best_team_vs')) }}</div>
        </div>
    </div>
</div>

{{-- COMBAT FULL POWER --}}
<div class="modal fade" id="addCombatModal" tabindex="-1" role="dialog" aria-labelledby="addCombatModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCombatModalTitle">{{ strtoupper(__('combat.max_power_combat')) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('combats.titans.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 py-1">
                                <div class="team-container team-a">
                                    <h4 class="text-center">{{ strtoupper(__('combat.team_a')) }}</h4>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalATitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalATitanIdTeamA" name="addCombatModalATitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalBTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalBTitanIdTeamA" name="addCombatModalBTitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalCTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalCTitanIdTeamA" name="addCombatModalCTitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalDTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalDTitanIdTeamA" name="addCombatModalDTitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalETitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalETitanIdTeamA" name="addCombatModalETitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-md-6 py-1">
                                <div class="team-container team-b">
                                    <h4 class="text-center">{{ strtoupper(__('combat.team_b')) }}</h4>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalATitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalATitanIdTeamB" name="addCombatModalATitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalBTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalBTitanIdTeamB" name="addCombatModalBTitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalCTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalCTitanIdTeamB" name="addCombatModalCTitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalDTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalDTitanIdTeamB" name="addCombatModalDTitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatModalETitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatModalETitanIdTeamB" name="addCombatModalETitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="mb-0" for="addCombatModalWinner">{{ ucfirst( __('combat.winner')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatModalWinner" name="addCombatModalWinner">
                                        <option value="a">{{ __('combat.team_a') }}</option>
                                        <option value="b">{{ __('combat.team_b') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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

{{-- COMBAT PERSONALIZED POWER --}}
<div class="modal fade" id="addCombatWithPowerModal" tabindex="-1" role="dialog" aria-labelledby="addCombatWithPowerModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCombatWithPowerModalTitle">{{ strtoupper(__('combat.personalized_power_combat')) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('combats.titans.storeWithPower') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6 py-1">
                                <div class="team-container team-a">
                                    <h4 class="text-center">{{ strtoupper(__('combat.team_a')) }}</h4>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalATitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalATitanIdTeamA" name="addCombatWithPowerModalATitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalATitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalATitanPowerTeamA" name="addCombatWithPowerModalATitanPowerTeamA">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalBTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalBTitanIdTeamA" name="addCombatWithPowerModalBTitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalBTitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalBTitanPowerTeamA" name="addCombatWithPowerModalBTitanPowerTeamA">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalCTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalCTitanIdTeamA" name="addCombatWithPowerModalCTitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalCTitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalCTitanPowerTeamA" name="addCombatWithPowerModalCTitanPowerTeamA">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalDTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalDTitanIdTeamA" name="addCombatWithPowerModalDTitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalDTitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalDTitanPowerTeamA" name="addCombatWithPowerModalDTitanPowerTeamA">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalETitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalETitanIdTeamA" name="addCombatWithPowerModalETitanIdTeamA">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalETitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalETitanPowerTeamA" name="addCombatWithPowerModalETitanPowerTeamA">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 py-1">
                                <div class="team-container team-b">
                                    <h4 class="text-center">{{ strtoupper(__('combat.team_b')) }}</h4>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalATitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalATitanIdTeamB" name="addCombatWithPowerModalATitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalATitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalATitanPowerTeamB" name="addCombatWithPowerModalATitanPowerTeamB">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalBTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalBTitanIdTeamB" name="addCombatWithPowerModalBTitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalBTitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalBTitanPowerTeamB" name="addCombatWithPowerModalBTitanPowerTeamB">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalCTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalCTitanIdTeamB" name="addCombatWithPowerModalCTitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalCTitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalCTitanPowerTeamB" name="addCombatWithPowerModalCTitanPowerTeamB">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalDTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalDTitanIdTeamB" name="addCombatWithPowerModalDTitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalDTitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalDTitanPowerTeamB" name="addCombatWithPowerModalDTitanPowerTeamB">
                                    </div>
                                    <hr>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalETitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatWithPowerModalETitanIdTeamB" name="addCombatWithPowerModalETitanIdTeamB">
                                            <option value="">{{ __('titan.select_titan') }}</option>
                                            @foreach( $titans as $titan )
                                                <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatWithPowerModalETitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalETitanPowerTeamB" name="addCombatWithPowerModalETitanPowerTeamB">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="mb-0" for="addCombatWithPowerModalWinner">{{ ucfirst( __('combat.winner')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatWithPowerModalWinner" name="addCombatWithPowerModalWinner">
                                        <option value="a">{{ __('combat.team_a') }}</option>
                                        <option value="b">{{ __('combat.team_b') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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

{{-- COMBAT FULL INFORMATION --}}
<div class="modal fade" id="addCombatFullInformationModal" tabindex="-1" role="dialog" aria-labelledby="addCombatFullInformationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCombatFullInformationModalTitle">{{ strtoupper(__('combat.full_information_combat')) }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('combats.titans.storeFullInformation') }}" method="post">
                <div class="modal-body">
                    @csrf

                    <div class="row">
                        <div class="col-12 col-md-6 py-1">
                            <div class="team-container team-a">
                                <h4 class="text-center">{{ strtoupper(__('combat.team_a')) }}</h4>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalATitanIdTeamA" name="addCombatFullInformationModalATitanIdTeamA">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalATitanPowerTeamA" name="addCombatFullInformationModalATitanPowerTeamA">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalATitanStarTeamA" name="addCombatFullInformationModalATitanStarTeamA">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalATitanRangeTeamA" name="addCombatFullInformationModalATitanRangeTeamA">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalBTitanIdTeamA" name="addCombatFullInformationModalBTitanIdTeamA">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalBTitanPowerTeamA" name="addCombatFullInformationModalBTitanPowerTeamA">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalBTitanStarTeamA" name="addCombatFullInformationModalBTitanStarTeamA">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalBTitanRangeTeamA" name="addCombatFullInformationModalBTitanRangeTeamA">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalCTitanIdTeamA" name="addCombatFullInformationModalCTitanIdTeamA">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalCTitanPowerTeamA" name="addCombatFullInformationModalCTitanPowerTeamA">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalCTitanStarTeamA" name="addCombatFullInformationModalCTitanStarTeamA">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalCTitanRangeTeamA" name="addCombatFullInformationModalCTitanRangeTeamA">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalDTitanIdTeamA" name="addCombatFullInformationModalDTitanIdTeamA">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalDTitanPowerTeamA" name="addCombatFullInformationModalDTitanPowerTeamA">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalDTitanStarTeamA" name="addCombatFullInformationModalDTitanStarTeamA">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalDTitanRangeTeamA" name="addCombatFullInformationModalDTitanRangeTeamA">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanIdTeamA">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalETitanIdTeamA" name="addCombatFullInformationModalETitanIdTeamA">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalETitanPowerTeamA" name="addCombatFullInformationModalETitanPowerTeamA">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalETitanStarTeamA" name="addCombatFullInformationModalETitanStarTeamA">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalETitanRangeTeamA" name="addCombatFullInformationModalETitanRangeTeamA">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 py-1">
                            <div class="team-container team-b">
                                <h4 class="text-center">{{ strtoupper(__('combat.team_b')) }}</h4>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalATitanIdTeamB" name="addCombatFullInformationModalATitanIdTeamB">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalATitanPowerTeamB" name="addCombatFullInformationModalATitanPowerTeamB">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalATitanStarTeamB" name="addCombatFullInformationModalATitanStarTeamB">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalATitanRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalATitanRangeTeamB" name="addCombatFullInformationModalATitanRangeTeamB">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalBTitanIdTeamB" name="addCombatFullInformationModalBTitanIdTeamB">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalBTitanPowerTeamB" name="addCombatFullInformationModalBTitanPowerTeamB">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalBTitanStarTeamB" name="addCombatFullInformationModalBTitanStarTeamB">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalBTitanRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalBTitanRangeTeamB" name="addCombatFullInformationModalBTitanRangeTeamB">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalCTitanIdTeamB" name="addCombatFullInformationModalCTitanIdTeamB">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalCTitanPowerTeamB" name="addCombatFullInformationModalCTitanPowerTeamB">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalCTitanStarTeamB" name="addCombatFullInformationModalCTitanStarTeamB">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalCTitanRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalCTitanRangeTeamB" name="addCombatFullInformationModalCTitanRangeTeamB">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalDTitanIdTeamB" name="addCombatFullInformationModalDTitanIdTeamB">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalDTitanPowerTeamB" name="addCombatFullInformationModalDTitanPowerTeamB">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalDTitanStarTeamB" name="addCombatFullInformationModalDTitanStarTeamB">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalDTitanRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalDTitanRangeTeamB" name="addCombatFullInformationModalDTitanRangeTeamB">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <hr>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanIdTeamB">{{ ucfirst( __('titan.select_titan')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalETitanIdTeamB" name="addCombatFullInformationModalETitanIdTeamB">
                                        <option value="">{{ __('titan.select_titan') }}</option>
                                        @foreach( $titans as $titan )
                                            <option value="{{ $titan->id }}">{{ $titan->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                    <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalETitanPowerTeamB" name="addCombatFullInformationModalETitanPowerTeamB">
                                </div>
                                <div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalETitanStarTeamB" name="addCombatFullInformationModalETitanStarTeamB">
                                        @foreach( $stars as $star )
                                            <option value="{{ $star }}">{{ $star }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--<div class="form-group mb-1">
                                    <label class="mb-0" for="addCombatFullInformationModalETitanRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                    <select class="form-control form-control-sm" id="addCombatFullInformationModalETitanRangeTeamB" name="addCombatFullInformationModalETitanRangeTeamB">
                                        @foreach( $ranges as $key=>$range )
                                            <option value="{{ $key }}">{{ $range }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-0" for="addCombatFullInformationModalWinner">{{ ucfirst( __('combat.winner')) }}</label>
                                <select class="form-control form-control-sm" id="addCombatFullInformationModalWinner" name="addCombatFullInformationModalWinner">
                                    <option value="a">{{ __('combat.team_a') }}</option>
                                    <option value="b">{{ __('combat.team_b') }}</option>
                                </select>
                            </div>
                        </div>
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
<style>
    .card-container {
        border: 1px solid #b7b6b6;
        padding: 10px;
        border-radius: 10px;
        background-color: #fff;
    }
    .team-container {
        border: 1px solid #bbb;
        padding: 10px;
        border-radius: 10px;
    }
    .team-a { background-color: #d4e9ff; }
    .team-b { background-color: #ffe6e3; }
    hr { border-color: #f00; }
</style>
@endsection

@section('js')
    <script>
        @if ( isset($errorMsg) && strlen($errorMsg) )
        alert('{{ $errorMsg }}');
        @elseif ( isset($successMsg) && strlen($successMsg) )
        alert('{{ $successMsg }}');
        @endif
    </script>
@endsection