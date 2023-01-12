@extends('adminlte::page')

@section('title', 'Refeitorio Social')

<?php
$countEquipamento1 = 0;
$countEquipamento2 = 0;
$countEquipamento3 = 0;
$nomeTask = '';
if($task == 1){
    $nomeTask = 'Almoço';
}else if ($task == 2){
    $nomeTask = 'Sopa';
}


function titulo_equipamento($id_equipamento)
{
    $equipamento = '';
    switch ($id_equipamento) {
        case 1:
            $equipamento = 'Refeitório Padre Mororó';
            break;
        case 2:
            $equipamento = 'Pousada Social Imperador';
            break;
        case 3:
            $equipamento = 'Refeitório São Vicente de Paulo';
            break;
    }
    echo $equipamento;
}

function calcula_porcentagem(float $valor_base, float $valor)
{
    try {
        return round(($valor / $valor_base) * 100);
    } catch (DivisionByZeroError $e) {
        echo "got $e";
    } catch (ErrorException $e) {
        echo "got $e";
    }

}
?>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="title text-uppercase"> {{ titulo_equipamento($id_equipamento) }} - {{ $nomeTask }}</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="form-group" style="margin-right:1rem">
                                <label for="dataInicial">Data Inicial</label>
                                <input type="date" id="dataInicial" name="dataInicial" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dataFinal">Data Final</label>
                                <input type="date" id="dataFinal" name="dataFinal" class="form-control">
                            </div>

                        </div>
                        <button style="width: 100%;" class="btn btn-primary">
                            Filtrar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Gráfico</h3>
                {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="maximize">
                        <i class="fas fa-expand"></i>
                        </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                     <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
                </div> --}}
            </div>
            <div class="card-body h-400">
                <canvas id="myChart" style="height:400px !important; flex-grow: 1"></canvas>
            </div>

        </div>
        <div class="container-fluid pt-3">

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-sort-amount-asc "></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total de Entregas</span>
                            <span class="info-box-number">{{ count($agendamento) }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-secondary"><i class="fas fa-hand-holding-usd"></i></span>
                        <div class="info-box-content">Beneficiário Aluguel Social</span>
                             <span class="info-box-number">{{ count($count_inseguranca_alimentar) }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-map-marker"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Morando na Rua</span>
                            <span class="info-box-number">{{ count($count_situacao_rua) }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Restrição Alimentar</span>
                            <span class="info-box-number">{{ count($count_restricao_alimentar) }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-wheelchair"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pessoa com Deficiência</span>
                            <span class="info-box-number">{{ count($count_deficiencia) }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div style="padding-top: 20px;">
            <div class="card card-dark ">
                <div class="card-header">
                    <h3 class="card-title">Registros de Entrega</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button> --}}
                    </div>
                </div>
                <div class="card-body table-responsive">
                    {{-- <p class="text-info">Filtrar por campo</p>
                    <input class="form-control" id="myInput" type="text" placeholder="Pesquisar.."> <br> --}}
                    <table id="myTable" class="table table-bordered table-striped table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Id Entrega</th>
                                <th scope="col">Id Beneficiário</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Equipamento</th>
                                <th scope="col">Data Entrega</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendamento as $beneficiarios_refeicao_entrega)
                                <tr>
                                    <td class="id">{{ $beneficiarios_refeicao_entrega->id }}</td>
                                    <td class="cpf">{{ $beneficiarios_refeicao_entrega->id_beneficiario }}</td>
                                    <td class="nis">{{ $beneficiarios_refeicao_entrega->nome }}</td>
                                    <td class="nome">{{ $beneficiarios_refeicao_entrega->equipamento }}</td>
                                    <td class="dt_nascimento">{{ $beneficiarios_refeicao_entrega->data }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>




@stop



@section('css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">


    <style>
        table th,
        td {
            text-align: center;
        }

        .card-clickable {
            transition: all 0.2s ease;
            cursor: pointer;
        }



        .card-clickable:hover {
            /*e9ecef*/
            box-shadow: 5px 6px 6px 2px #9a9da0;
            transform: scale(1.1);
        }
    </style>


@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d8e2fcabdf.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>




    <script>
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order": [0, 'desc'],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    "paginate": {
                        "next": "Próximo",
                        "previous": "Anterior",
                        "first": "Primeira",
                        "last": "Última",
                    },
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ linhas",
                    "emptyTable": "Sem dados disponíveis na tabela",
                    "search": "Pesquisar:",
                }
            });
        });
    </script>



    <script type="text/javascript">
        var blueIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var yellowIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var padre_mororo = L.marker([-3.7224905, -38.5371395, 19.25], {
                icon: blueIcon
            }).bindPopup('REFEITÓRIO SOCIAL PADRE MORORÓ'),
            imperador = L.marker([-3.7276825, -38.5349758, 18.75], {
                icon: greenIcon
            }).bindPopup('POUSADA SOCIAL AVENIDA IMPERADOR'),
            sao_vicente_de_paulo = L.marker([-3.7429724, -38.5417368, 19], {
                icon: yellowIcon
            }).bindPopup('REFEITÓRIO SÃO VICENTE DE PAULO');


        var refeitorios = L.layerGroup([padre_mororo, imperador, sao_vicente_de_paulo]);



        var layoutMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var map = L.map('map', {
            //center: [-3.76838, -38.535683],
            center: [-3.732537, -38.525534],
            zoom: 14,
            layers: [layoutMap, refeitorios]
        });

        var baseMaps = {
            "OpenStreetMap": layoutMap
        };

        var overlayMaps = {
            "<strong>REFEITÓRIOS</strong>": refeitorios,
        };

        L.control.layers(baseMaps, overlayMaps).addTo(map);
    </script>

    <script>
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });



        $(document).on("click", "#btnVisualizar", function() {
            var id = $(this).closest('tr').find(".id").text();
            var nome = $(this).closest('tr').find(".nome").text();
            var dt_nascimento = $(this).closest('tr').find(".dt_nascimento").text();
            var nis = $(this).closest('tr').find(".nis").text();
            var cpf = $(this).closest('tr').find(".cpf").text();
            var mae = $(this).closest('tr').find(".mae").text();
            var restricao_alimentar = $(this).closest('tr').find(".restricao_alimentar").text();
            var tipo_beneficiario = $(this).closest('tr').find(".tipo_beneficiario").text();
            console.log(id);
            console.log(nome);
            var array = {
                id: id,
                nome: nome,
            }

            //Gambiarra pra botar a data no input

            $('#visualizaId').text(id);
            $('#visualizaNome').text(nome);
            $('#visualizaDt_nascimento').text(dt_nascimento);
            $('#visualizaNis').text(nis);
            $('#visualizaCpf').text(cpf);
            $('#visualizaMae').text(mae);
            $('#visualizaRestricao_alimentar').text(restricao_alimentar);
            $('#visualizaTipo_beneficiario').text(tipo_beneficiario);
        });

        $(document).on("click", "#btn-realizar-checkIn-", function() {
            var id = $(this).closest('tr').find(".id").text();
            var nome = $(this).closest('tr').find(".nome").text();
            var equipamento = $(this).closest('tr').find(".equipamento").text();
            console.log(id);
            console.log(nome);
            var array = {
                id: id,
                nome: nome,
            }

            //Gambiarra pra botar a data no input

            $('#inputId').val(id);
            $('#inputNome').val(nome);
        });
    </script>

    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif


        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    {{-- <script>
            var msg = '{{ Session::get('alert') }}';
            var exist = '{{ Session::has('alert') }}';
            if (exist) {
                var div = $("<div />Mensagem");
                div.attr({
                    id: 'minha_div',
                    title: 'estilo',
                    class: 'alert alert-danger',
                    role: 'alert',
                    value: msg
                });

                $(".container").append(div);
            }
        </script> --}}
    <script>
        @if($task == 1)
            var taskJs = 'Entrega de Almoços'
        @elseif ($task == 2)
            var taskJs = 'Entrega de Sopas'
        @endif
        const labels = [
            @foreach ($grafico as $graficos)
                '{{ implode('/', array_reverse(explode('-', $graficos->data))) }}',
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: taskJs,
                data: [
                    @foreach ($grafico as $graficos)
                        '{{ $graficos->id }}',
                    @endforeach
                ],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        display: true,
                        fontSize: 30
                    }

                }

            }

        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

@stop
