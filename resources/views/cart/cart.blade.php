@extends('plantilla')
@section('pagecontent')
    <section class="container-bootstrap">
        <div class="topclear">
            &nbsp;
        </div>
        <div class="row">
            <div class="col-sm-12">
                @include('holders.notificaciones')
            </div>
        </div>

        @if (Auth::guest())
            <div class="col-sm-12">
                <h1 class="gotham2 text-center" style="padding: 15vh 0;">¡Inicia sesión o registrate con nosotros!
                    <br><br><br>
                    <button type="button" data-toggle="modal" data-target="#loginmodal" class="btn btn-success"
                            style="width: 65%; margin: 0 auto;">Entrar
                    </button>
                </h1>
            </div>
        @else
			<?php $user = App\User::find( Auth::user()->id );?>
    </section>
    <div class="container-bootstrap-fluid">
        <div class="col-sm-12">
            <div class="cart-header">
                <div class="row">
                    <div class="col-xs-3 col-sm-1  col-md-1">
                        <h1 class="title"><strong class="numofclass">{{$paquete->num_clases}}</strong></h1>
                    </div>
                    <div class="col-xs-9 col-sm-4 col-md-4">
                        <h1 class="title"> CLASES {{$paquete->tipo}}<strong class="numofclass">&nbsp;</strong></h1>
                    </div>
                    <div class="col-xs-3 col-sm-1 col-sm-offset-1 col-md-1 col-md-offset-1">
                        <h1 class="title"><strong
                                    class="numofclass">&nbsp;</strong><strong>${{$paquete->precio}}</strong></h1>
                    </div>
                    <div class="col-xs-9 col-sm-5 col-md-5 text-right">
                        <h1 class="title"><strong class="numofclass">&nbsp;</strong>Expiran en {{$paquete->dias}} días
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="container-bootstrap">
        <div class="row">
            <div class="col-sm-12">
				<?php $descuento = Cookie::get( 'descuentofc' );
				$cuponera = App\Cuponera::find( $descuento );
				?>
                @if($descuento)
                    <div class="collapse in" id="carrito">
                        <div class="">
                            <div class="panel-body">


                                <div class="row">
                                    <div class="col-xs-4">
                                        <h4 class="product-name"><strong>{{ $cuponera->descripcion }}</strong></h4>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="col-xs-10 text-right gotham2">
                                            <h6><strong>- ${{ $cuponera->monto }} <span
                                                            class="text-muted"></span></strong></h6>
                                        </div>
                                    </div>
                                </div>


                                <hr>

                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <p>&nbsp;</p>
            @if(!$descuento)
                <div class="">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="coupon">

                            <form action="{{url('descuento')}}" method="POST">
                                {!! csrf_field() !!}
                                <input class="" type="text" name="codigo" size="20" value=""
                                       placeholder="Aplicar código de descuento" required>
                                <button type="submit" class="applyCoupon"><i class="fa fa-arrow-right"
                                                                             aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            <p>&nbsp;</p>

            <form action="{{url('cargo')}}" method="POST" id="payment-form">
                <input id="tokencsrf" type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" value="{{$paquete->id}}" name="paquete"/>
                <input type="hidden" id="token_id" name="token_id"/>
                <div class="">
                    <div class="col-sm-6 col-sm-offset-3">


                        <div class="form-group">
                            <div class="col-xs-12 text-center">

                                <i class="fa fa-cc-visa fa-2x">&nbsp;</i> <i
                                        class="fa fa-cc-mastercard fa-2x">&nbsp;</i> <i class="fa fa-cc-amex fa-2x">&nbsp;</i>
                            </div>
                            <p>&nbsp;</p>
                        </div>
                        @if (!$user->tarjetas->isEmpty())
                            <div class="form-group row">
                                <label class="col-sm-3 control-label" for="card-number">Tarjeta</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="tarjeta" name="tarjeta">
                                        <option value="">Nueva tarjeta</option>
                                        @foreach ($user->tarjetas as $tarjeta)
                                            <option value="{{$tarjeta->id}}">{{$tarjeta->identificador}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        @endif
                        <div class="form-group row" id="tarjeta1label">

                            <div class="col-xs-12">

                                <input class="form-control" id="numtarjeta" name="numero"
                                       placeholder="Número de tarjeta" autocomplete="off"
                                       data-openpay-card="card_number" maxlength="16" type="text"></div>
                        </div>
                        <div class="form-group row">
                            <div id="tarjeta2label">
                                <div class="col-sm-5 col-xs-12">
                                    <input class="form-control" id="nombretitular" name="nombre"
                                           placeholder="Nombre del titular" autocomplete="off"
                                           data-openpay-card="holder_name" type="text"></div>
                                <div class="col-sm-2 col-xs-3">
                                    <input class="form-control" id="mm" placeholder="MM" name="mes"
                                           data-openpay-card="expiration_month" type="text" maxlength="2"></div>
                                <div class="col-sm-2 col-xs-3">
                                    <input class="form-control" id="aa" placeholder="AA" name="año"
                                           data-openpay-card="expiration_year" type="text" maxlength="2"></div>
                            </div>
                            <label class="col-sm-3 control-label" for="card-number" id="cvvlabel" style="display:none;">Código
                                de seguridad:</label>
                            <div class="col-sm-3 col-xs-6">
                                <div class="input-group">
                                    <input class="form-control" id="cvv" placeholder="CVV" autocomplete="off"
                                           data-openpay-card="cvv2" maxlength="4" type="text"> <span
                                            class="input-group-btn"> <button type="button" class="form-control"
                                                                             data-toggle="popover" data-container="body"
                                                                             data-placement="top"
                                                                             data-content="Código de seguridad de 3 dígitos ubicado normalmente en la parte trasera de su tarjeta. Las tarjetas American Express tienen un código de 4 dígitos ubicado en el frente.">?</button> </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="tarjeta3label">
                            <div class="col-xs-12">
                                <div class="checkbox">
                                    <label>
                                        <input name="guardartarjeta" value="si" type="checkbox" id="guardartarjeta">
                                        Guardar tarjeta
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="identificadorcont" style="display: none;">
                            <div class="col-xs-12">
                                <label>Identificador:</label>
                            </div>
                            <div class="col-xs-12">
                                <input type="text" name="identificadortarjeta" class="form-control"
                                       placeholder="Ej: Crédito, Mi tarjeta, Banco ..." id="identificador">
                            </div>
                        </div>
                        <input type="hidden" name="name" value="{{$user->name}}">
                        <input type="hidden" name="email" value="{{$user->email}}">
                        <input type="hidden" name="phone" value="{{$user->tel}}">


                        <div class="form-group">
                            <div class="col-sm-12 text-right">
                                <a id="pay-button" class="btn btn-success" type="submit">Pagar</a>
                                <p>&nbsp;</p>
                                <p class="text-center" style="color: #ccc !important;"> En tu estado de cuenta aparecerá
                                    la leyenda <img src="{{url('/images/op.png')}}" style="max-width:50px;">*FITCOACH
                                </p>
                                <script>
                                    $('#pay-button').on('click', function () {
                                        $('#pay-button').addClass('disabled');
                                    });
                                </script>

                                <button id="boton" type="submit" style="display:none"></button>

                            </div>
                        </div>
                    </div>
                </div>

            </form>

            @if (!$user->direcciones->isEmpty())
                <script type="text/javascript">
                    $('#direccion').change(function () {
                        if ($('#direccion').val() != "") {

                            $('#identificadorNuevo').prop("disabled", true);
                            $('#calleNuevo').prop("disabled", true);
                            $('#numero_extNuevo').prop("disabled", true);
                            $('#numero_intNuevo').prop("disabled", true);
                            $('#coloniaNuevo').prop("disabled", true);
                            $('#municipio_delNuevo').prop("disabled", true);
                            $('#cpNuevo').prop("disabled", true);
                            $('#estadoNuevo').prop("disabled", true);
                            $('#identificadorNuevolabel').hide();
                            $('#calleNuevolabel').hide();
                            $('#numero_extNuevolabel').hide();
                            $('#numero_intNuevolabel').hide();
                            $('#coloniaNuevolabel').hide();
                            $('#municipio_delNuevolabel').hide();
                            $('#cpNuevolabel').hide();
                            $('#estadoNuevolabel').hide();

                        }
                        else {
                            $('#identificadorNuevo').prop("disabled", false);
                            $('#calleNuevo').prop("disabled", false);
                            $('#numero_extNuevo').prop("disabled", false);
                            $('#numero_intNuevo').prop("disabled", false);
                            $('#coloniaNuevo').prop("disabled", false);
                            $('#municipio_delNuevo').prop("disabled", false);
                            $('#cpNuevo').prop("disabled", false);
                            $('#estadoNuevo').prop("disabled", false);
                            $('#identificadorNuevolabel').show();
                            $('#calleNuevolabel').show();
                            $('#numero_extNuevolabel').show();
                            $('#numero_intNuevolabel').show();
                            $('#coloniaNuevolabel').show();
                            $('#municipio_delNuevolabel').show();
                            $('#cpNuevolabel').show();
                            $('#estadoNuevolabel').show();

                        }
                    });
                </script>
            @endif
            @if (!$user->tarjetas->isEmpty())
                <script type="text/javascript">
                    $('#tarjeta').change(function () {
                        if ($('#tarjeta').val() != "") {

                            /*  $('#numtarjeta').prop( "disabled", true );
                              $('#nombretitular').prop( "disabled", true );
                              $('#mm').prop( "disabled", true );
                              $('#aa').prop( "disabled", true );

                              $('#guardartarjeta').prop( "disabled", true );*/

                            $('#tarjeta1label').hide();
                            $('#tarjeta2label').hide();
                            $('#tarjeta3label').hide();
                            $('#cvvlabel').show();
                            tarjeta = $('#tarjeta').val();
                            _token = $('#tokencsrf').val();
                            $.post("{{url('/')}}/cargartarjeta", {

                                tarjeta: tarjeta,
                                _token: _token
                            }, function (data) {
                                val = data.split(",");
                                $('#numtarjeta').val(val[0]);
                                $('#nombretitular').val(val[1]);
                                $('#mm').val(val[2]);
                                $('#aa').val(val[3]);
                            });
                        }
                        else {
                            /*$('#numtarjeta').prop( "disabled", false );
                            $('#nombretitular').prop( "disabled", false );
                            $('#mm').prop( "disabled", false );
                            $('#aa').prop( "disabled", false );
                            $('#cvv').prop( "disabled", false );
                            $('#guardartarjeta').prop( "disabled", false );*/

                            $('#tarjeta1label').show();
                            $('#tarjeta2label').show();
                            $('#tarjeta3label').show();
                            $('#cvvlabel').hide();


                        }
                    });
                </script>

            @endif
            <script type="text/javascript">
                $(document).ready(function () {
                    $('[data-toggle="popover"]').popover();
                });
                $("#guardartarjeta").click(function () {
                    if ($(this).is(':checked')) {
                        $('#identificadorcont').show();
                        $("#identificador").attr("", true);
                    }
                    else {
                        $('#identificadorcont').hide();
                        $("#identificador").attr("", false);
                    }
                });


                //api openpay
                $(document).ready(function () {
                    OpenPay.setId('mtxcxt534uf7g731pnty');
                    OpenPay.setApiKey('pk_3e69354359be4e8bb3fe4ee38583435b');
                    OpenPay.setSandboxMode(false);
                    //Se genera el id de dispositivo
                    var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

                    $('#pay-button').on('click', function (event) {
                        event.preventDefault();
                        $("#pay-button").prop("disabled", true);
                        OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
                    });

                    var sucess_callbak = function (response) {
                        var token_id = response.data.id;
                        $('#token_id').val(token_id);

                        $('#boton').click();

                    };

                    var error_callbak = function (response) {

                        $('#pay-button').removeClass('disabled');

                        var desc = response.data.description != undefined ? response.data.description : response.message;
                        alert("ERROR [" + response.status + "] " + desc);
                        $("#pay-button").prop("disabled", false);

                    };
                });
                //termina api openpay
            </script>
            @endif


        </div>
    </section>
@endsection
