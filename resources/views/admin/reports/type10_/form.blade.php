@extends('plantilla')
@section('pagecontent')
    <section class="container">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="row profile">
            <div class="col-sm-12">
                @include('holders.notificaciones')
            </div>
        </div>
        <div class="">
            <div class="container-bootstrap-fluid">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="title" style="font-size: 10vw; float: left; line-height: 0.8;">REPORTES</div>
                    </div>
                </div>
                <br/>
                <form method="POST" action="/reportes/1">
                    {!! csrf_field() !!}
                    <div class="row" style="height: 300px">
                        <div class="col-sm-4">
                            <input type="text" class="form-control datepicker" name="date" placeholder="Hasta..." value="">
                        </div>
                        <div class="col-lg-4">
                            <div class="dropdown">
                                <button class="btn btn-success" type="submit">Generar</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <p>&nbsp;</p>

        </div>
    </section>

