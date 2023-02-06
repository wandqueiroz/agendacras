$(document).ready(function () {

    let calendarEl = document.querySelector('.calendar');
    let calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        initialView: 'dayGridMonth',
        selectable: true,
        selectMirror: true,
        headerToolbar: {
            start: 'prev,next,today',
            center: 'title',
            end: 'dayGridMonth'
            //end: 'dayGridMonth, timeGridWeek, timeGridDay'
        },
        buttonText: {
            today: 'hoje',
            month: 'mês',
            week: 'semana',
            day: 'dia'
        },
        locale: 'pt-br',
        dateClick: function (info) {
            let txt_unidade = $('#unidade').find(":selected").text();
            if(txt_unidade != '-' && txt_unidade != ''){
                $(".horarios-header").empty();
            $(".horarios-corpo").empty();
            //alert('Clicked on: ' + info.dateStr);
            //alert('Current view: ' + info.view.type);
            // change the day's background color just for fun
            //info.dayEl.style.backgroundColor = 'red';
            var data = calendar.formatDate(info.dateStr, {
                month: 'numeric',
                year: 'numeric',
                day: 'numeric'
            });
            var titulo = $("<h3 id='id' class='header-horarios'>" + data + "</h3><br>" +
                "");
            $(".horarios-header").append(titulo);

            var corpo = $("<button type='button' id='08-00' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>08:00</button><button type='button' id='08-40' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>08:40</button>" +
                "<button type='button' id='09-20' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>09:20</button>" +
                "<button type='button' id='10-00' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>10:00</button>" +
                "<button type='button' id='10-40' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>10:40</button>" +
                "<button type='button' id='11-20' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>11:20</button>" +
                "<button type='button' id='13-00' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>13:00</button>" +
                "<button type='button' id='13-40' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>13:40</button>" +
                "<button type='button' id='14-20' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>14:20</button>" +
                "<button type='button' id='15-00' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>15:00</button>" +
                "<button type='button' id='15-40' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>15:40</button>" +
                "<button type='button' id='16-20' class='btn btn-success btn-horarios' data-toggle='modal' data-target='#modalBuscaCPF'>16:20</button>");

            $(".horarios-corpo").append(corpo);


                /* var valor = $(this).html();
                alert("Horario de "+ valor + " agendado com sucesso!"); */
                let id_unidade = $('#unidade').find(":selected").val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "/orderdataTec",
                    type: "POST",
                    data: {
                        dia: info.dateStr,
                        id_unidade: id_unidade,
                        _token: _token
                    },
                    success: function (response) {
                        //console.log(response.success['0']['horario']);
                         if (response) {

                            for (let i = 0; i < response.success.length; ++i) {
                                let hora_replaced = response.success[i]['horario'].replace(":", "-");
                                fazer(hora_replaced)
                            }


                        }
                    },
                    error: function (error) {
                        console.log(error);

                    }
                });

                function fazer(hora){
                    $("#"+hora).removeClass('btn-success');
                    $("#"+hora).addClass('btn-danger');
                    $("#"+hora).attr('disabled', 'disabled');
                }

                 $('.btn-horarios').click(function() {
                    //var form = $('.form-novo-agendamento');
                    var horario = $(this).html();
                    preencherModal(info.dateStr, horario );

                    // if (form.hasClass("hidden")) {
                    //    form.removeClass("hidden").addClass("visible");

                    //} else {
                    //    form.removeClass("visible").addClass("hidden");
                    //}
                });


            //$("#08:00").attr('disabled', 'disabled');
            }else{
                alert("SELECIONE PRIMEIRO O BAIRRO E A UNIDADE DE REFERÊNCIA");
            }




        },
        businessHours: {
            // days of week. an array of zero-based day of week integers (0=Sunday)
            daysOfWeek: [1, 2, 3, 4, 5], // Monday - Thursday

            startTime: '10:00', // a start time (10am in this example)
            endTime: '18:00', // an end time (6pm in this example)
            selectable: false
        }
    });


    calendar.render();
});
