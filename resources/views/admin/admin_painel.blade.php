@extends('adminlte::page')

@section('title', 'Editar Cadastro')

@section('content')

    <div class="container-fluid">
        @can('is_admin')
            <h1 class="text-center text-info mb-3">Painel Administrativo</h1>

            <div class="card">
                <div class="card-header">
                    <h4 class="text-secondary">Usuários</h4>
                </div>
                <div class="card-body table-responsive">
                    <table id="myTable" class="table table-bordered table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Perfil</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td class="id">{{ $usuario->id }}</td>
                                    <td class="name">{{ $usuario->name }}</td>
                                    <td class="email">{{ $usuario->email }}</td>
                                    <td class="status">{{ $usuario->status }}</td>
                                    <td class="perfil">{{ $usuario->perfil }}</td>
                                    <td class="acoes">
                                        <a href="{{ route('resetarSenha', ['id' => $usuario->id]) }}" class="btn bg-primary"
                                            id="btn-checkIn" data-toggle="modal" data-target="#modalStatus">
                                            <i class="fa fa-refresh" aria-hidden="true"></i> Mudar Status </a>
                                        &ensp;
                                        <a href="{{ route('resetarSenha', ['id' => $usuario->id]) }}" class="btn btn-info"
                                            id="btn-checkIn"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Resetar Senha
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <p class="modal-title" id="modalStatusLabel">Alterar Status</p>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin-update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input class="form-control" type="number" name="id" id="inputIdStatus"
                                                hidden="true">
                                        </div>
                                        <h5 class="text-secondary" id="txtModalStatus"></h5>
                                        <div class="form-group">
                                            <select class="form-control" id="inputStatus" name="status">
                                                <option value="pre_cadastrado">Pré-Cadastrado</option>
                                                <option value="ativo">Ativo</option>
                                                <option value="inativo">Inativo</option>

                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="form-group">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fechar</button>

                                                <input type="submit" name="submit" class="btn btn-success" value="Atualizar">
                                            </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @endcan
    @cannot('is_admin')
        <div class="container pt-5">
            <h1 class="text-center text-info">ACESSO NEGADO!</h1>
            <h1 class="text-center text-info">PÁGINA RESTRITA</h1>
            <figure class="text-center">
                {{-- <img src="https://cdn-icons-png.flaticon.com/512/89/89084.png?w=360" alt="Minha Figura"> --}}
                <img src="https://pt.seaicons.com/wp-content/uploads/2016/05/Sign-Stop-icon.png" alt="Acesso Negado">
                {{-- <img src="https://c.tenor.com/RU0lNYxWTPoAAAAC/chloe-grace-moretz-black-and-white.gif" alt="Minha Figura"> --}}
            </figure>
        </div>
    @endcannot
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/d8e2fcabdf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


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
    <script>
        $('#modalStatus').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        });

        $(document).on("click", "#btn-checkIn", function() {
            var id = $(this).closest('tr').find(".id").text();
            var name = $(this).closest('tr').find(".name").text();
            var status = $(this).closest('tr').find(".status").text();
            console.log(id);
            console.log(status);
            var array = {
                id: id,
                name: name,
                status: status
            };

            $('#inputIdStatus').val(id);
            $('#txtModalStatus').text('Alterar o status atual de ' + name);
            $('#inputStatus').val(status);
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
@stop
