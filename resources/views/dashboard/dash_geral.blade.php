@extends('adminlte::page')

@section('title', 'Refeitorio Social')

<?php
$countEquipamento1 = 0;
$countEquipamento2 = 0;
$countEquipamento3 = 0;
$countEquipamento4 = 0;
$producaoDiaEquip1 = 0;
$producaoDiaEquip2 = 0;
$producaoDiaEquip3 = 0;
$producaoDiaEquip4 = 0;
$totalproducao = [
    'green' => 0,
    'yellow' => 0,
    'red' => 0,
];

$corEquip1 = [
    'icon' => '',
    'cor' => '',
];
$corEquip2 = [
    'icon' => '',
    'cor' => '',
];
$corEquip3 = [
    'icon' => '',
    'cor' => '',
];
$corEquip4 = [
    'icon' => '',
    'cor' => '',
];

foreach ($agendamento as $beneficiarios) {
    if ($beneficiarios->unidade === '1') {
        $countEquipamento1++;
    } elseif ($beneficiarios->unidade === '2') {
        $countEquipamento2++;
    } elseif ($beneficiarios->unidade === '3') {
        $countEquipamento3++;
    } elseif ($beneficiarios->unidade === '4') {
        $countEquipamento4++;
    }
}

foreach ($agendamento_distinct as $retorno) {
    if ($retorno->unidade == '1') {
        $producaoDiaEquip1++;
    }
    if ($retorno->unidade == '2') {
        $producaoDiaEquip2++;
    }
    if ($retorno->unidade == '3') {
        $producaoDiaEquip3++;
    }
    if ($retorno->unidade == '4') {
        $producaoDiaEquip4++;
    }
}

//Verifica  total por cor
if ($producaoDiaEquip1 != 0) {
    if ($countEquipamento1 / $producaoDiaEquip1 >= 10) {
        $totalproducao['green']++;
        $corEquip1['icon'] = 'greenIcon';
        $corEquip1['cor'] = 'ForestGreen';
    } elseif ($countEquipamento1 / $producaoDiaEquip1 < 10 && $countEquipamento1 / $producaoDiaEquip1 >= 5) {
        $totalproducao['yellow']++;
        $corEquip1['icon'] = 'yellowIcon';
        $corEquip1['cor'] = 'GoldenRod';
    } else {
        $totalproducao['red']++;
        $corEquip1['icon'] = 'redIcon';
        $corEquip1['cor'] = 'Crimson';
    }
} else {
    $totalproducao['red']++;
    $corEquip1['icon'] = 'redIcon';
    $corEquip1['cor'] = 'Crimson';
}

if ($producaoDiaEquip2 != 0) {
    if ($countEquipamento2 / $producaoDiaEquip2 >= 10) {
        $totalproducao['green']++;
        $corEquip2['icon'] = 'greenIcon';
        $corEquip2['cor'] = 'ForestGreen';
    } elseif ($countEquipamento2 / $producaoDiaEquip2 < 10 && $countEquipamento2 / $producaoDiaEquip2 >= 5) {
        $totalproducao['yellow']++;
        $corEquip2['icon'] = 'yellowIcon';
        $corEquip2['cor'] = 'GoldenRod';
    } else {
        $totalproducao['red']++;
        $corEquip2['icon'] = 'redIcon';
        $corEquip2['cor'] = 'Crimson';
    }
} else {
    $totalproducao['red']++;
    $corEquip2['icon'] = 'redIcon';
    $corEquip2['cor'] = 'Crimson';
}


    if ($producaoDiaEquip3 != 0) {
        if ($countEquipamento3 / $producaoDiaEquip3 >= 10) {
            $totalproducao['green']++;
            $corEquip3['icon'] = 'greenIcon';
            $corEquip3['cor'] = 'ForestGreen';
        } elseif ($countEquipamento3 / $producaoDiaEquip3 < 10 && $countEquipamento3 / $producaoDiaEquip3 >= 5) {
            $totalproducao['yellow']++;
            $corEquip3['icon'] = 'yellowIcon';
            $corEquip3['cor'] = 'GoldenRod';
        } else {
            $totalproducao['red']++;
            $corEquip3['icon'] = 'redIcon';
            $corEquip3['cor'] = 'Crimson';
        }
    } else {
        $totalproducao['red']++;
        $corEquip3['icon'] = 'redIcon';
        $corEquip3['cor'] = 'Crimson';
    }

    if ($producaoDiaEquip4 != 0) {
        if ($countEquipamento4 / $producaoDiaEquip4 >= 10) {
            $totalproducao['green']++;
            $corEquip4['icon'] = 'greenIcon';
            $corEquip4['cor'] = 'ForestGreen';
        } elseif ($countEquipamento4 / $producaoDiaEquip4 < 10 && $countEquipamento4 / $producaoDiaEquip4 >= 5) {
            $totalproducao['yellow']++;
            $corEquip4['icon'] = 'yellowIcon';
            $corEquip4['cor'] = 'GoldenRod';
        } else {
            $totalproducao['red']++;
            $corEquip4['icon'] = 'redIcon';
            $corEquip4['cor'] = 'Crimson';
        }
    } else {
        $totalproducao['red']++;
        $corEquip4['icon'] = 'redIcon';
        $corEquip4['cor'] = 'Crimson';
    }

function getDiasUteis($dtInicio, $dtFim, $feriados = [])
{
    $tsInicio = strtotime($dtInicio);
    $tsFim = strtotime($dtFim);

    $quantidadeDias = 0;
    while ($tsInicio <= $tsFim) {
        // Verifica se o dia é igual a sábado ou domingo, caso seja continua o loop
        $diaIgualFinalSemana = date('D', $tsInicio) === 'Sat' || date('D', $tsInicio) === 'Sun';
        // Verifica se é feriado, caso seja continua o loop
        $diaIgualFeriado = count($feriados) && in_array(date('Y-m-d', $tsInicio), $feriados);

        $tsInicio += 86400; // 86400 quantidade de segundos em um dia

        if ($diaIgualFinalSemana || $diaIgualFeriado) {
            continue;
        }

        $quantidadeDias++;
    }

    return $quantidadeDias;
}

function calcula_porcentagem(float $valor_base, float $valor)
{
    try {
        return round(($valor / $valor_base) * 100);
    } catch (DivisionByZeroError $e) {
        //Route::get('/home', [\App\Http\Controllers\BeneficiariosController::class, 'index'])->name('beneficiarios-index');
        echo "got $e";
    } catch (ErrorException $e) {
        //Route::get('/home', [\App\Http\Controllers\BeneficiariosController::class, 'index'])->name('beneficiarios-index');
        echo "got $e";
    }
}

?>

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8">
                @if ($task == 1)
                    <h1 class="title text-uppercase text-center text-info mb-3"> Dashboard Geral Atendimento    do Cadastro Único
                         - {{ count($agendamento) }} -
                    {{ $countEquipamento1 }} - {{ $countEquipamento2 }} - {{ $countEquipamento3 }} - {{ $countEquipamento4 }}  </h1>
                @elseif($task == 2)
                    <h1 class="title text-uppercase text-center text-info mb-3"> Dashboard Geral de Entregas de Sopas
                        {{-- {{ count($agendamento) }} -
                        {{ $producaoDiaEquip2 }} - {{ $producaoDiaEquip3 }} --}} </h1>
                @endif
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

        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">

                        {{-- <h3>

                            @switch(request("t"))
                                @case(1)
                                {{array_sum($total1)}}
                                @break

                                @case(2)
                                {{array_sum($total2)}}
                                @break
                            @endswitch

                        </h3> --}}
                        <h3>{{ count($agendamento) }}</h3>

                        <p>Total de entregas</p>
                    </div>

                    <div class="icon">
                        <i class="fa fa-thumb-tack"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>


            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}

                        {{-- <h3>{{ $green }}</h3> --}}
                        <h3>{{ $totalproducao['green'] }}</h3>

                        <p>Bom Desempenho</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-alt-circle-up"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        {{-- <h3>{{ $yellow }}</h3> --}}
                        <h3>{{ $totalproducao['yellow'] }}</h3>
                        <p>Médio Desempenho</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        {{-- <h3>{{ $red }}</h3> --}}
                        <h3>{{ $totalproducao['red'] }}</h3>
                        <p>Baixo Desempenho</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-arrow-alt-circle-down"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais informações <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3><span class="badge bg-warning text-dark text-wrap" style="width: 100%;">Clique para visualizar
                                por
                                Equipamento</span> </h3>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead class="bg-light">
                                    <tr class="bg-secondary">
                                        <th>Equipamento</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a class="myLink" href="/dash/1/{{ $task }}"><strong>
                                                    Ant. Bezerra</strong></a></td>
                                        <td><span class="info-box-icon" style="color:{{ $corEquip1['cor'] }}"><i
                                    class="fa fa-bookmark"></i></span></td>

                                    </tr>
                                    <tr>
                                        <td><a class="myLink" href="/dash/2/{{ $task }}"
                                            ><strong>Aracapé</strong></a></td>
                                        <td><span class="info-box-icon" style="color:{{ $corEquip2['cor'] }}"><i
                                    class="fa fa-bookmark"></i></span></td>

                                    </tr>
                                    <tr>
                                        <td><a class="myLink" href="/dash/3/{{ $task }}"><strong>Barra do
                                                    Ceará</strong></a></td>
                                        <td><span class="info-box-icon" style="color:{{ $corEquip3['cor'] }}"><i
                                    class="fa fa-bookmark"></i></span></td>

                                    </tr>
                                    <tr>
                                        <td><a class="myLink" href="/dash/1/{{ $task }}"><strong>Bela
                                                    Vista</strong></a></td>
                                        <td><span class="info-box-icon" style="color:{{ $corEquip4['cor'] }}"><i
                                    class="fa fa-bookmark"></i></span></td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>



                </div>
            </div>

            <div class="col-lg-9">

                <div class="card card-dark ">
                    <div class="card-header">
                        <h3 class="card-title">Mapa de Localização</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                        </div>
                    </div>
                    <div class="card-body table-responsive flex-column">
                        <div id="map" style="height: 400px"></div>
                    </div>
                </div>


            </div>

        </div>

        <div class="card card-dark mt-2">
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
                        <span class="info-box-icon bg-purple"><i class="fas fa-hand-holding-usd"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Beneficiário Aluguel Social</span>
                            <span class="info-box-number">{{ 10 }}</span>
                        </div>

                    </div>

                </div>

                {{-- <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-home "></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Aluguel Social</span>
                            <span class="info-box-number">{{ count($count_aluguel_social) }}</span>
                        </div>

                    </div>

                </div> --}}

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fa fa-map-marker"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Morando na Rua</span>
                            <span class="info-box-number">{{ 10 }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Restrição Alimentar</span>
                            <span class="info-box-number">{{ 10 }}</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fa fa-wheelchair"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pessoa com Deficiência</span>
                            <span class="info-box-number">{{ 10 }}</span>
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
                    <table id="myTable" class="table table-bordered table-striped dataTable dtr-inline">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>

                                <th scope="col">Nome</th>
                                <th scope="col">Unidade</th>
                                <th scope="col">Data Atendimento</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendamento as $agendamentos)
                                <tr>
                                    <td class="id">{{ $agendamentos->id }}</td>
                                    <td class="nis">{{ $agendamentos->nome }}</td>
                                    <td class="nome">{{ $agendamentos->unidade }}</td>
                                    <td class="dt_nascimento">{{ $agendamentos->data }}</td>
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
        a:link, a:visited, a:active{text-decoration: none; color: #2b2b2b}
        a:hover{
            color: #9a9da0;
        }
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
            transform: scale(0.9);
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


        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
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


        var antonio_bezerra = L.marker([-3.73738717362533, -38.59026731003803], {
            icon: @php echo $corEquip1['icon'] @endphp
        }).bindPopup('CRAS ANTONIO BEZERRA');

        var aracape = L.marker([-3.829444183266811, -38.59087424088926], {
            icon: @php echo $corEquip2['icon'] @endphp
        }).bindPopup('CRAS ARACAPE');
        var barra_do_ceara = L.marker([-3.7084672496570725, -38.5799618048817], {
            icon: @php echo $corEquip3['icon'] @endphp
        }).bindPopup('CRAS BARRA DO CEARA');
        var bela_vista = L.marker([-3.752174852258905, -38.56037893565068], {
            icon: @php echo $corEquip4['icon'] @endphp
        }).bindPopup('CRAS BELA VISTA');

        var equipamentos = L.layerGroup([antonio_bezerra, aracape, barra_do_ceara, bela_vista]);

        var layoutMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var map = L.map('map', {
            //center: [-3.76838, -38.535683],
            center: [-3.798471524399541, -38.545947514483466],
            zoom: 11.2,
            layers: [layoutMap, equipamentos]
        });

        var baseMaps = {
            "OpenStreetMap": layoutMap
        };

        var overlayMaps = {
            "<strong>REFEITÓRIOS</strong>": equipamentos,
        };

        L.control.layers(baseMaps, overlayMaps).addTo(map);



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


        /*     <script>
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
                    } */
    </script>
    <script>
        const labels = [
            @foreach ($grafico as $graficos)
                '{{ implode('/', array_reverse(explode('-', $graficos->data))) }}',
            @endforeach
        ];
        const data = {
            labels: labels,
            datasets: [{
                label: 'Gráfico do Histórico',
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
