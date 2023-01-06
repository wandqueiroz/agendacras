@extends('adminlte::auth.register')

<div class='light x1'></div>
<div class='light x2'></div>
<div class='light x3'></div>
<div class='light x4'></div>
<div class='light x5'></div>
<div class='light x6'></div>
<div class='light x7'></div>
<div class='light x8'></div>
<div class='light x9'></div>

@section('css')
    <style>
        .input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control, .input-group>.form-control-plaintext{
            background-color: transparent;
            font-size: 18;
        }
        .btn-primary{
            background-color: #20c997;
            border-color: #20c997;
        }

        .btn-primary:hover{
            background-color: #019669;
            border-color: #019669;
        }

        .register-card-body .input-group .input-group-text{
            background-color: #20c997;
            color: #fff;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.521);
            border-radius: .25em;
            box-shadow: 0 0 .25em rgba(0, 0, 0, .25);
            box-sizing: border-box;

        }

        .register-card-body {
            background-color: rgba(255, 255, 255, 0);
            border-radius: .25em;
            box-shadow: 0 0 .25em rgba(0, 0, 0, .25);
            box-sizing: border-box;

        }

        .card-primary.card-outline {
            border-top: 3px solid #20c997;
        }

        .register-page {
            background: radial-gradient(#eaee09, #1f1013);
            -webkit-overflow-Y: hidden;
            -moz-overflow-Y: hidden;
            -o-overflow-Y: hidden;
            overflow-y: hidden;
            -webkit-animation: fadeIn 1 1s ease-out;
            -moz-animation: fadeIn 1 1s ease-out;
            -o-animation: fadeIn 1 1s ease-out;
            animation: fadeIn 1 1s ease-out;
        }

        .light {
            position: absolute;
            width: 0px;
            opacity: .75;
            background-color: white;
            box-shadow: #e9f1f1 0px 0px 20px 2px;
            opacity: 0;
            top: 100vh;
            bottom: 0px;
            left: 0px;
            right: 0px;
            margin: auto;
        }

        .x1 {
            -webkit-animation: floatUp 4s infinite linear;
            -moz-animation: floatUp 4s infinite linear;
            -o-animation: floatUp 4s infinite linear;
            animation: floatUp 4s infinite linear;
            -webkit-transform: scale(1.0);
            -moz-transform: scale(1.0);
            -o-transform: scale(1.0);
            transform: scale(1.0);
        }

        .x2 {
            -webkit-animation: floatUp 7s infinite linear;
            -moz-animation: floatUp 7s infinite linear;
            -o-animation: floatUp 7s infinite linear;
            animation: floatUp 7s infinite linear;
            -webkit-transform: scale(1.6);
            -moz-transform: scale(1.6);
            -o-transform: scale(1.6);
            transform: scale(1.6);
            left: 15%;
        }

        .x3 {
            -webkit-animation: floatUp 2.5s infinite linear;
            -moz-animation: floatUp 2.5s infinite linear;
            -o-animation: floatUp 2.5s infinite linear;
            animation: floatUp 2.5s infinite linear;
            -webkit-transform: scale(.5);
            -moz-transform: scale(.5);
            -o-transform: scale(.5);
            transform: scale(.5);
            left: -15%;
        }

        .x4 {
            -webkit-animation: floatUp 4.5s infinite linear;
            -moz-animation: floatUp 4.5s infinite linear;
            -o-animation: floatUp 4.5s infinite linear;
            animation: floatUp 4.5s infinite linear;
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
            left: -34%;
        }

        .x5 {
            -webkit-animation: floatUp 8s infinite linear;
            -moz-animation: floatUp 8s infinite linear;
            -o-animation: floatUp 8s infinite linear;
            animation: floatUp 8s infinite linear;
            -webkit-transform: scale(2.2);
            -moz-transform: scale(2.2);
            -o-transform: scale(2.2);
            transform: scale(2.2);
            left: -57%;
        }

        .x6 {
            -webkit-animation: floatUp 3s infinite linear;
            -moz-animation: floatUp 3s infinite linear;
            -o-animation: floatUp 3s infinite linear;
            animation: floatUp 3s infinite linear;
            -webkit-transform: scale(.8);
            -moz-transform: scale(.8);
            -o-transform: scale(.8);
            transform: scale(.8);
            left: -81%;
        }

        .x7 {
            -webkit-animation: floatUp 5.3s infinite linear;
            -moz-animation: floatUp 5.3s infinite linear;
            -o-animation: floatUp 5.3s infinite linear;
            animation: floatUp 5.3s infinite linear;
            -webkit-transform: scale(3.2);
            -moz-transform: scale(3.2);
            -o-transform: scale(3.2);
            transform: scale(3.2);
            left: 37%;
        }

        .x8 {
            -webkit-animation: floatUp 4.7s infinite linear;
            -moz-animation: floatUp 4.7s infinite linear;
            -o-animation: floatUp 4.7s infinite linear;
            animation: floatUp 4.7s infinite linear;
            -webkit-transform: scale(1.7);
            -moz-transform: scale(1.7);
            -o-transform: scale(1.7);
            transform: scale(1.7);
            left: 62%;
        }

        .x9 {
            -webkit-animation: floatUp 4.1s infinite linear;
            -moz-animation: floatUp 4.1s infinite linear;
            -o-animation: floatUp 4.1s infinite linear;
            animation: floatUp 4.1s infinite linear;
            -webkit-transform: scale(0.9);
            -moz-transform: scale(0.9);
            -o-transform: scale(0.9);
            transform: scale(0.9);
            left: 85%;
        }

        button:focus {
            outline: none;
        }

        @-webkit-keyframes floatUp {
            0% {
                top: 100vh;
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            50% {
                top: 0vh;
                opacity: .8;
            }

            75% {
                opacity: 1;
            }

            100% {
                top: -100vh;
                opacity: 0;
            }
        }

        @-moz-keyframes floatUp {
            0% {
                top: 100vh;
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            50% {
                top: 0vh;
                opacity: .8;
            }

            75% {
                opacity: 1;
            }

            100% {
                top: -100vh;
                opacity: 0;
            }
        }

        @-o-keyframes floatUp {
            0% {
                top: 100vh;
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            50% {
                top: 0vh;
                opacity: .8;
            }

            75% {
                opacity: 1;
            }

            100% {
                top: -100vh;
                opacity: 0;
            }
        }

        @keyframes floatUp {
            0% {
                top: 100vh;
                opacity: 0;
            }

            25% {
                opacity: 1;
            }

            50% {
                top: 0vh;
                opacity: .8;
            }

            75% {
                opacity: 1;
            }

            100% {
                top: -100vh;
                opacity: 0;
            }
        }
    </style>
@stop
