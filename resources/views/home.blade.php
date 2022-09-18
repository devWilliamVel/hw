@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <style>
        .widget-user .widget-user-image > img {
            width: 100px!important;
        }
    </style>
@stop

@section('content')
    <div id="AdBlockerAlert" class="col-12 justify-content-center bg-danger text-center" style="display: none">
        {{--è stato rilevata un'estensione di blocco degli annunci, per un corretto funzionamento della pagina si consiglia di disabilitare l'estensione per questo sito--}}
    </div>
    <h1 style="text-align: center">DASHBOARD</h1>

    <div class="col-12">
        <div class="card card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">
                    {{ Auth::user()->name }}
                </h3>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2" src="img/logo/hw_logo.png" alt="User Avatar" style="width: 100px!important;height: 100px!important;">
                <!-- @todo Image or avatar -->
            </div>
            <div class="card-footer">
                <div class="row">
                    <!-- #### TODAY'S ORDERS ################################################## -->
                    <div class="col-12 col-md-4">
                        <div class="small-box bg-gradient-success">
                            <div class="inner">
                                <h3>{{ $battlesToday ?? '' }}</h3>
                                <p>batallas registradas hoy</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-fist-raised"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- #### PENDING SHIPPINGS ############################################### -->
                    <div class="col-12 col-md-4">
                        <div class="small-box bg-gradient-warning">
                            <div class="inner">
                                <h3>{{ $usersCounter ?? '' }}</h3>
                                <p>Usuarios</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- #### PENDING EMAILS ################################################## -->
                    <div class="col-12 col-md-4">
                        <div class="small-box bg-gradient-danger">
                            <div class="inner">
                                <h3>{{ $guildsCounter ?? '' }}</h3>
                                <p>Gremios</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                Ver <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
@stop

@section('css')
    {{--<link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')

@stop

@section('extraContent')
    <script src="{{getCssJsPath('js/wp-banners.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        if ( ! document.getElementById('divAdvBlocker234') )
            $('#AdBlockerAlert').css('display', 'flex');

    </script>
@stop
