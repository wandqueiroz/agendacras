@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>FORMULÁRIO DE COMUNICAÇÃO DE CONCESSÃO DE FÉRIAS</h1>
@stop

@section('content')

    <div class="container">

        <div class="folha p-3" id="folha">

            <div style="display: flex; justify-content: space-between; padding-top:-20px;">
                <img src="{{ asset(config('adminlte.logo_horizontal')) }}" height="130">
                <h5>ORGÃO: SDHDS</h5>

            </div>
            <h4 class="text-right col-md-12"><strong>COMUNICAÇÃO DE CONCESSÃO DE FÉRIAS</strong></h4>

            <hr size="10" width="100%">
            <div>
                <label for="nomeModal">Nome do Servidor</label>
                <h5 id="nomeModal"> </h5>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label for="cargoModal">Cargo/Função</label>
                    <h5 id="cargoModal"> </h5>
                </div>
                <div class="col-md-2">
                    <label for="matriculaModal">Matrícula</label>
                    <h5 id="matriculaModal"> </h5>
                </div>
                <div class="col-md-2">
                    <label for="folhaModal">Folha</label>
                    <h5 id="folhaModal"> </h5>
                </div>
            </div>


            <div class="div-texto p-5">
                <p>Sr. (a) Diretor (a)</p>
                <br>
                <p>Conforme normas regulamentares de concessão de férias para os servidores da
                    <strong>PREFEITURA
                        MUNICIPAL DE FORTALEZA</strong>,
                    comunicamos-lhe que as férias do servidor supra mencionado relativas ao ano de <strong id="anoModal">
                    </strong>
                    serão utilizadas no período de <strong id="dataInicialModal"> </strong> à <strong id="dataFinalModal">
                    </strong>
                    retornando ao trabalho no dia: <strong id="dataRetornoModal"> </strong>.
                </p>
            </div>

            <div class="row">

                <div class="card text-center col-md-6">
                    <div class="card-header">
                        <p class="text-center card-title" style="font-size:13px">ASSINATURA DO
                            REQUERENTE / DATA
                        </p>
                    </div>
                    <div class="card-body">

                        <br><br>
                    </div>
                    <div class="card-footer">
                        <br>
                        <div style="display: flex; justify-content: space-between;">
                            <small class="text-muted">________________________________________________</small>
                            <small class="text-muted">______/______/______</small>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <small class="text-muted">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Assinatura</small>
                            <small class="text-muted">Data&emsp;&emsp;&emsp;&emsp;</small>
                        </div>
                    </div>
                </div>

                <div class="card text-center col-md-6">
                    <div class="card-header">
                        <p class="text-center card-title" style="font-size:13px">CARIMBO E ASSINATURA
                            DO CHEFE
                            IMEDIATO / DATA</p>
                    </div>
                    <div class="card-body">

                        <br><br>
                    </div>
                    <div class="card-footer">
                        <br>
                        <div style="display: flex; justify-content: space-between;">
                            <small class="text-muted">________________________________________________</small>
                            <small class="text-muted">______/______/______</small>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <small class="text-muted">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Assinatura</small>
                            <small class="text-muted">Data&emsp;&emsp;&emsp;&emsp;</small>
                        </div>

                    </div>
                </div>

            </div>



        </div>

    </div>
    {{--  --}}



@stop

@section('css')
    <style type="text/css">
        .folha {
            background-image: linear-gradient(rgba(254, 255, 217, 0.9) 0%, rgba(254, 255, 217, 0.9) 100%), url('{{ asset(config('adminlte.logo_img')) }}');
            background-repeat: no-repeat;
            background-size: 100%;
        }
    </style>
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#inputAnoRef').mask('0000');
            $('#inputDataInicial').mask('00/00/0000');
            $('#inputDataFinal').mask('00/00/0000');
            $('#inputDataRetorno').mask('00/00/0000');


        });

        $('#btnGerarDoc').click(function() {
            var nome = $('#inputNome').val();
            var cargo = $('#inputCargo').val();
            var matricula = $('#inputMatricula').val();
            var folha = $('#inputFolha').val();
            var anoReferencia = $('#inputAnoRef').val();
            var dataInicial = $('#inputDataInicial').val();
            var dataFinal = $('#inputDataFinal').val();
            var dataRetorno = $('#inputDataRetorno').val();


            $('#nomeModal').text(nome);
            $('#cargoModal').text(cargo);
            $('#matriculaModal').text(matricula);
            $('#folhaModal').text(folha);
            $('#anoModal').text(anoReferencia);
            $('#dataInicialModal').text(dataInicial);
            $('#dataFinalModal').text(dataFinal);
            $('#dataRetornoModal').text(dataRetorno);

        });
    </script>
    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus');

        });
    </script>
@stop
