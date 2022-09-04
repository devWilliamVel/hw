@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2 class="text-center mb-2">{{ strtoupper(__('combat.heroes_combat')) }}</h2>
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
                <form action="{{ route('combats.heroes.store') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-6 py-1">
                                    <div class="team-container team-a">
                                        <h4 class="text-center">{{ strtoupper(__('combat.team_a')) }}</h4>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalAHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalAHeroIdTeamA" name="addCombatModalAHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalBHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalBHeroIdTeamA" name="addCombatModalBHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalCHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalCHeroIdTeamA" name="addCombatModalCHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalDHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalDHeroIdTeamA" name="addCombatModalDHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalEHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalEHeroIdTeamA" name="addCombatModalEHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalPetIdTeamA">{{ ucfirst( __('pet.select_pet')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalPetIdTeamA" name="addCombatModalPetIdTeamA">
                                                <option value="">{{ __('pet.select_pet') }}</option>
                                                @foreach( $pets as $pet )
                                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 py-1">
                                    <div class="team-container team-b">
                                        <h4 class="text-center">{{ strtoupper(__('combat.team_b')) }}</h4>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalAHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalAHeroIdTeamB" name="addCombatModalAHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalBHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalBHeroIdTeamB" name="addCombatModalBHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalCHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalCHeroIdTeamB" name="addCombatModalCHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalDHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalDHeroIdTeamB" name="addCombatModalDHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalEHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalEHeroIdTeamB" name="addCombatModalEHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatModalPetIdTeamB">{{ ucfirst( __('pet.select_pet')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatModalPetIdTeamB" name="addCombatModalPetIdTeamB">
                                                <option value="">{{ __('pet.select_pet') }}</option>
                                                @foreach( $pets as $pet )
                                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
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
                <form action="{{ route('combats.heroes.storeWithPower') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-md-6 py-1">
                                    <div class="team-container team-a">
                                        <h4 class="text-center">{{ strtoupper(__('combat.team_a')) }}</h4>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalAHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalAHeroIdTeamA" name="addCombatWithPowerModalAHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalAHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalAHeroPowerTeamA" name="addCombatWithPowerModalAHeroPowerTeamA">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalBHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalBHeroIdTeamA" name="addCombatWithPowerModalBHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalBHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalBHeroPowerTeamA" name="addCombatWithPowerModalBHeroPowerTeamA">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalCHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalCHeroIdTeamA" name="addCombatWithPowerModalCHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalCHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalCHeroPowerTeamA" name="addCombatWithPowerModalCHeroPowerTeamA">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalDHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalDHeroIdTeamA" name="addCombatWithPowerModalDHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalDHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalDHeroPowerTeamA" name="addCombatWithPowerModalDHeroPowerTeamA">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalEHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalEHeroIdTeamA" name="addCombatWithPowerModalEHeroIdTeamA">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalEHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalEHeroPowerTeamA" name="addCombatWithPowerModalEHeroPowerTeamA">
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatWithPowerModalPetIdTeamA">{{ ucfirst( __('pet.select_pet')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalPetIdTeamA" name="addCombatWithPowerModalPetIdTeamA">
                                                <option value="">{{ __('pet.select_pet') }}</option>
                                                @foreach( $pets as $pet )
                                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalPetPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalPetPowerTeamA" name="addCombatWithPowerModalPetPowerTeamA">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 py-1">
                                    <div class="team-container team-b">
                                        <h4 class="text-center">{{ strtoupper(__('combat.team_b')) }}</h4>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalAHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalAHeroIdTeamB" name="addCombatWithPowerModalAHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalAHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalAHeroPowerTeamB" name="addCombatWithPowerModalAHeroPowerTeamB">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalBHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalBHeroIdTeamB" name="addCombatWithPowerModalBHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalBHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalBHeroPowerTeamB" name="addCombatWithPowerModalBHeroPowerTeamB">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalCHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalCHeroIdTeamB" name="addCombatWithPowerModalCHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalCHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalCHeroPowerTeamB" name="addCombatWithPowerModalCHeroPowerTeamB">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalDHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalDHeroIdTeamB" name="addCombatWithPowerModalDHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalDHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalDHeroPowerTeamB" name="addCombatWithPowerModalDHeroPowerTeamB">
                                        </div>

                                        <hr>

                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalEHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalEHeroIdTeamB" name="addCombatWithPowerModalEHeroIdTeamB">
                                                <option value="">{{ __('hero.select_hero') }}</option>
                                                @foreach( $heroes as $hero )
                                                    <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalEHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalEHeroPowerTeamB" name="addCombatWithPowerModalEHeroPowerTeamB">
                                        </div>

                                        <hr>

                                        <div class="form-group">
                                            <label class="mb-0" for="addCombatWithPowerModalPetIdTeamB">{{ ucfirst( __('pet.select_pet')) }}</label>
                                            <select class="form-control form-control-sm" id="addCombatWithPowerModalPetIdTeamB" name="addCombatWithPowerModalPetIdTeamB">
                                                <option value="">{{ __('pet.select_pet') }}</option>
                                                @foreach( $pets as $pet )
                                                    <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label class="mb-0" for="addCombatWithPowerModalPetPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                            <input type="number" class="form-control form-control-sm" id="addCombatWithPowerModalPetPowerTeamB" name="addCombatWithPowerModalPetPowerTeamB">
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
                <form action="{{ route('combats.heroes.storeFullInformation') }}" method="post">
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            <div class="col-12 col-md-6 py-1">
                                <div class="team-container team-a">
                                    <h4 class="text-center">{{ strtoupper(__('combat.team_a')) }}</h4>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroIdTeamA" name="addCombatFullInformationModalAHeroIdTeamA">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalAHeroPowerTeamA" name="addCombatFullInformationModalAHeroPowerTeamA">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroStarTeamA" name="addCombatFullInformationModalAHeroStarTeamA">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroRangeTeamA" name="addCombatFullInformationModalAHeroRangeTeamA">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroPetTeamA">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroPetTeamA" name="addCombatFullInformationModalAHeroPetTeamA">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroIdTeamA" name="addCombatFullInformationModalBHeroIdTeamA">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalBHeroPowerTeamA" name="addCombatFullInformationModalBHeroPowerTeamA">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroStarTeamA" name="addCombatFullInformationModalBHeroStarTeamA">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroRangeTeamA" name="addCombatFullInformationModalBHeroRangeTeamA">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroPetTeamA">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroPetTeamA" name="addCombatFullInformationModalBHeroPetTeamA">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroIdTeamA" name="addCombatFullInformationModalCHeroIdTeamA">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalCHeroPowerTeamA" name="addCombatFullInformationModalCHeroPowerTeamA">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroStarTeamA" name="addCombatFullInformationModalCHeroStarTeamA">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroRangeTeamA" name="addCombatFullInformationModalCHeroRangeTeamA">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroPetTeamA">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroPetTeamA" name="addCombatFullInformationModalCHeroPetTeamA">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroIdTeamA" name="addCombatFullInformationModalDHeroIdTeamA">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalDHeroPowerTeamA" name="addCombatFullInformationModalDHeroPowerTeamA">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroStarTeamA" name="addCombatFullInformationModalDHeroStarTeamA">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroRangeTeamA" name="addCombatFullInformationModalDHeroRangeTeamA">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroPetTeamA">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroPetTeamA" name="addCombatFullInformationModalDHeroPetTeamA">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroIdTeamA">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroIdTeamA" name="addCombatFullInformationModalEHeroIdTeamA">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalEHeroPowerTeamA" name="addCombatFullInformationModalEHeroPowerTeamA">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroStarTeamA" name="addCombatFullInformationModalEHeroStarTeamA">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroRangeTeamA" name="addCombatFullInformationModalEHeroRangeTeamA">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroPetTeamA">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroPetTeamA" name="addCombatFullInformationModalEHeroPetTeamA">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatFullInformationModalPetIdTeamA">{{ ucfirst( __('pet.select_pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalPetIdTeamA" name="addCombatFullInformationModalPetIdTeamA">
                                            <option value="">{{ __('pet.select_pet') }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalPetPowerTeamA">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalPetPowerTeamA" name="addCombatFullInformationModalPetPowerTeamA">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalPetStarTeamA">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalPetStarTeamA" name="addCombatFullInformationModalPetStarTeamA">
                                            @foreach( $petStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalPetRangeTeamA">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalPetRangeTeamA" name="addCombatFullInformationModalPetRangeTeamA">
                                            @foreach( $petRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 py-1">
                                <div class="team-container team-b">
                                    <h4 class="text-center">{{ strtoupper(__('combat.team_b')) }}</h4>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroIdTeamB" name="addCombatFullInformationModalAHeroIdTeamB">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalAHeroPowerTeamB" name="addCombatFullInformationModalAHeroPowerTeamB">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroStarTeamB" name="addCombatFullInformationModalAHeroStarTeamB">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroRangeTeamB" name="addCombatFullInformationModalAHeroRangeTeamB">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalAHeroPetTeamB">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalAHeroPetTeamB" name="addCombatFullInformationModalAHeroPetTeamB">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroIdTeamB" name="addCombatFullInformationModalBHeroIdTeamB">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalBHeroPowerTeamB" name="addCombatFullInformationModalBHeroPowerTeamB">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroStarTeamB" name="addCombatFullInformationModalBHeroStarTeamB">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroRangeTeamB" name="addCombatFullInformationModalBHeroRangeTeamB">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalBHeroPetTeamB">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalBHeroPetTeamB" name="addCombatFullInformationModalBHeroPetTeamB">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroIdTeamB" name="addCombatFullInformationModalCHeroIdTeamB">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalCHeroPowerTeamB" name="addCombatFullInformationModalCHeroPowerTeamB">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroStarTeamB" name="addCombatFullInformationModalCHeroStarTeamB">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroRangeTeamB" name="addCombatFullInformationModalCHeroRangeTeamB">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalCHeroPetTeamB">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalCHeroPetTeamB" name="addCombatFullInformationModalCHeroPetTeamB">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroIdTeamB" name="addCombatFullInformationModalDHeroIdTeamB">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalDHeroPowerTeamB" name="addCombatFullInformationModalDHeroPowerTeamB">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroStarTeamB" name="addCombatFullInformationModalDHeroStarTeamB">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroRangeTeamB" name="addCombatFullInformationModalDHeroRangeTeamB">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalDHeroPetTeamB">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalDHeroPetTeamB" name="addCombatFullInformationModalDHeroPetTeamB">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroIdTeamB">{{ ucfirst( __('hero.select_hero')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroIdTeamB" name="addCombatFullInformationModalEHeroIdTeamB">
                                            <option value="">{{ __('hero.select_hero') }}</option>
                                            @foreach( $heroes as $hero )
                                                <option value="{{ $hero->id }}">{{ $hero->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalEHeroPowerTeamB" name="addCombatFullInformationModalEHeroPowerTeamB">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroStarTeamB" name="addCombatFullInformationModalEHeroStarTeamB">
                                            @foreach( $heroStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroRangeTeamB" name="addCombatFullInformationModalEHeroRangeTeamB">
                                            @foreach( $heroRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalEHeroPetTeamB">{{ ucfirst( __('general.pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalEHeroPetTeamB" name="addCombatFullInformationModalEHeroPetTeamB">
                                            <option value="">{{ ucfirst(__('pet.select_pet')) }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label class="mb-0" for="addCombatFullInformationModalPetIdTeamB">{{ ucfirst( __('pet.select_pet')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalPetIdTeamB" name="addCombatFullInformationModalPetIdTeamB">
                                            <option value="">{{ __('pet.select_pet') }}</option>
                                            @foreach( $pets as $pet )
                                                <option value="{{ $pet->id }}">{{ $pet->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalPetPowerTeamB">{{ ucfirst( __('general.power')) }}</label>
                                        <input type="number" class="form-control form-control-sm" id="addCombatFullInformationModalPetPowerTeamB" name="addCombatFullInformationModalPetPowerTeamB">
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalPetStarTeamB">{{ ucfirst( __('general.stars')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalPetStarTeamB" name="addCombatFullInformationModalPetStarTeamB">
                                            @foreach( $petStars as $star )
                                                <option value="{{ $star }}">{{ $star }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-1">
                                        <label class="mb-0" for="addCombatFullInformationModalPetRangeTeamB">{{ ucfirst( __('general.range')) }}</label>
                                        <select class="form-control form-control-sm" id="addCombatFullInformationModalPetRangeTeamB" name="addCombatFullInformationModalPetRangeTeamB">
                                            @foreach( $petRanges as $key=>$range )
                                                <option value="{{ $key }}">{{ $range }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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