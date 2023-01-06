@extends('adminlte::auth.login')


<div class="outer">
</div>

@section('css')
    <style>
        .input-group>.custom-file,
        .input-group>.custom-select,
        .input-group>.form-control,
        .input-group>.form-control-plaintext {
            background-color: rgba(0, 0, 0, 0.5);;
            font-size: 18;
        }
        .input-group>.custom-file,
        .input-group>.custom-select,
        .input-group>.form-control,
        .input-group>.form-control-plaintext::placeholder{
            color: rgb(255, 255, 255);
        }

        .btn-primary {
            background-color: #d3b11c;
            border-color: #d3b11c;
            color: #464101;

        }
        .btn-primary:hover {
            background-color: #c2a215;
            border-color: #c2a215;
        }

        .login-card-body .input-group .input-group-text {
            background-color: #d3b11c;
            color: #5c5600;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.521);
            border-radius: .25em;
            box-shadow: 0 0 .25em rgba(0, 0, 0, .25);
            box-sizing: border-box;

        }
        .my-0>a, .card-header>h3, label{
            color: whitesmoke;
        }

        .login-card-body {
            background-color: rgba(255, 255, 255, 0);
            border-radius: .25em;
            box-shadow: 0 0 .25em rgba(0, 0, 0, .25);
            box-sizing: border-box;

        }

        .card-primary.card-outline {
            border-top: 3px solid #d3b11c;
        }

        .login-page {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            animation: animate 30s ease-in-out infinite;
            background-size: cover;

        }

        .login-logo>h4 {
            color: #ffffff;
        }

        .outer {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            z-index: -1;
        }

        @keyframes animate {

            0%,
            100% {
                background-image: url('vendor/adminlte/dist/img/background1.jpg')
            }

            20% {
                background-image: url('vendor/adminlte/dist/img/background2.jpg')
            }

            40% {
                background-image: url('vendor/adminlte/dist/img/background3.jpg')
            }

            60% {
                background-image: url('vendor/adminlte/dist/img/background6.jpg')
            }

            80% {
                background-image: url('vendor/adminlte/dist/img/background5.jpg')
            }


        }
    </style>
@stop
