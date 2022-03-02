<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ asset('images/icon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ion.rangeSlider2.min.css') }}">
    <link rel="icon" href="{{ asset('images/icon.png') }}" sizes="32x32">
	<link rel="icon" href="{{ asset('images/icon.png') }}" sizes="192x192">
	<link rel="apple-touch-icon-precomposed" href="{{ asset('images/icon.png') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/jquery.canvasjs.min.js') }}"></script>
    <script src="{{ asset('js/ion.rangeSlider.min.js') }}"></script>
</head>
<body>
    <main class="container">
        <div class="space"></div>
        <div class="fila">
            <div class="columna columna-1">
                <div class="title2">
                    <h6>{{ __('Productos peruanos en campaña') }}</h6>
                </div>
            </div>
        </div>
        <div class="fila">
            <div class="columna columna-1">
                <h6 class="title3">Presione sobre uno de los siguientes productos</h6>
            </div>
        </div>
        <div class="fila">
            <div class="columna columna-1">
                <form action="manifests.dataEvol" method="get">
                    <input type="hidden" id="product_id" name="product_id">
                    <div class="btn-products">
                        @inject('products','App\Services\Products')
                        @foreach ($products->getInCampaign() as $index => $product)
                        <input type="submit" id="{{ $index }}" name="{{ $index }}" value="{{ $product }}" onclick="myFunction(this)">
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
        <div class="fila result">
            <div class="columna columna-1">
                <div id="tab">
                    <div class="columna columna-2">
                        <button class="tablinks active" onclick="openTab(event,'tab-dia')">Diario</button>
                        <button class="tablinks" onclick="openTab(event,'tab-sem')">Semanal</button>
                        <button class="tablinks" onclick="openTab(event,'tab-mes')">Mensual</button>
                    </div>
                    <div class="columna columna-4">
                        @inject('months','App\Services\Months')
                        <select id="numMes" name="numMes" style="margin-bottom:0">
                            @foreach ($months->getAll() as $index => $month)
                            <option value="{{ $index }}">Mostrar desde {{ $month }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="columna columna-4">
                        <select id="slt-chart" style="margin-bottom:0">
                            <option value="splineArea">Área con línea suavizada</option>
                            <option value="area">Área con línea recta</option>
                            <option value="spline">Línea suavizada</option>
                            <option value="line">Línea recta</option>
                            <option value="column">Columnas</option>
                        </select>
                    </div>
                </div>
                <label class="text-title">{{ __('Volumen total exportado de ') }} {{ Str::lower($prodNm ?? '') }} {{ __(' (en kg)') }}</label>
                <label class="text-subtitle">{{ __('Datos actualizados al ') }} {{ Carbon\Carbon::parse($maxDate ?? '')->format('d/m/Y') }}</label>
                <div class="tamano">
                    <div id="tab-mes" class="tabcontent">
                        <div id="chartEvolMes"></div>
                    </div>
                    <div id="tab-sem" class="tabcontent">
                        <div id="chartEvolSem"></div>
                    </div>
                    <div id="tab-dia" class="tabcontent">
                        <div id="chartEvolDia"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fila result">
            <div class="columna columna-2">
                <div id="contPaisMes" class="table-cont">
                    <label id="titlePaisMes" class="text-title"></label>
                    <label id="sbTtlPaisMes" class="text-subtitle"></label>
                    <label id="rsltdPaisMes" class="text-comm"></label>
                    <div id="chartPaisMes" class="chartPais"></div>
                </div>
                <div id="contPaisSel" class="range-cont">
                    <input type="text" class="js-range-slider" id="rangePaisSel">
                </div>
            </div>
            <div class="columna columna-2">
                <div id="contExpoMes" class="table-cont">
                    <label id="titleExpoMes" class="text-title"></label>
                    <label id="sbTtlExpoMes" class="text-subtitle"></label>
                    <label id="rsltdExpoMes" class="text-comm"></label>
                    <table id="tableExpoMes" class="tablealumno"></table>
                </div>
                <div id="contExpoSel" class="range-cont">
                    <input type="text" class="js-range-slider" id="rangeExpoSel">
                </div>
            </div>
        </div>
        <div class="fila">
            <div class="columna columna-1">
                <p>
                    <i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;
                    <b>Aviso de limitación de responsabilidad: </b>
                    La información y análisis vertidos en este informe son una guía de la situación de la industria de exportación de productos frescos peruanos. No se acepta responsabilidad por las consecuencias de acciones tomadas como resultado de la aplicación de esta información.
                </p>
            </div>
        </div>
    </main>
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
        }
    });

    function myFunction(e) {
        $('#product_id').val(e.name);
    }

    function openTab(e, tab) {
        var tabcontent = document.getElementsByClassName('tabcontent');
        var tablinks = document.getElementsByClassName('tablinks');

        for (var i=0; i<tabcontent.length; i++) {
            tabcontent[i].style.display = 'none';
        }
        
        for (var i=0; i<tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(' active','');
        }
        
        document.getElementById(tab).style.display = 'block';
        e.currentTarget.className += ' active';
    }

    $(function() {
        var product_id = <?= json_encode($product_id ?? '') ?>;

        if (product_id) {
            $('#'+product_id).prop('disabled',true);
            $('.result').css('display','block');
            var prodNm = (<?= json_encode($prodNm ?? '') ?>).toLowerCase();
            var shortMonths = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Set','Oct','Nov','Dic'];
            var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Setiembre','Octubre','Noviembre','Diciembre'];
            var msgGenDat = 'Generando gráfico...';
            var msgNotDat = 'No se encontraron resultados para el período seleccionado.';
            var fontColor = '#808080';
            var lineColor = '#5AB248';
            var placement = 'inside';
            var dashType = 'dash';
            var toolTip = '{x}: {y} kg';
            var theme = 'light2';
            var cult = 'es';
            CanvasJS.addCultureInfo(cult, {months: months, shortMonths: shortMonths});
            var ptosCmp = reporteCampanias(<?php echo json_encode($ptosCmp ?? '') ?>);
            var evolDia = reporteEvolutivo(<?php echo json_encode($evolDia ?? '') ?>);
            var evolSem = reporteEvolutivo(<?php echo json_encode($evolSem ?? '') ?>);
            var evolMes = reporteEvolutivo(<?php echo json_encode($evolMes ?? '') ?>);
            var charDia = graficoEvolutivo('chartEvolDia','DD MMM YY','day',evolDia);
            var charSem = graficoEvolutivo('chartEvolSem','DD MMM YY','week',evolSem);
            var charMes = graficoEvolutivo('chartEvolMes','MMMM YYYY','month',evolMes);
            cargarSlider('rangePaisSel',reportePaises);
            cargarSlider('rangeExpoSel',reporteExport);
            mostrarAnimacion();
            //Tabs evolutivo
            $('#tab').tabs({
                create: function (event, ui) {
                    //Render Charts after tabs have been created.
                    $('#chartEvolDia').CanvasJSChart(charDia);
                    $('#chartEvolSem').CanvasJSChart(charSem);
                    $('#chartEvolMes').CanvasJSChart(charMes);
                },
                activate: function (event, ui) {
                    //Updates the chart to its container size if it has changed.
                    ui.newPanel.children().first().CanvasJSChart().render();
                }
            });
        }
        else {
            var div = $('.btn-products');
            $(":first-child", div).click();
        }
        
        //Llenado de puntos campañas
        function reporteCampanias(data) {
            var points = [];
            $.each(data, function(i, item) {
                points.push({
                    start_at: new Date(item.start_at),
                    end_at: new Date(item.end_at)
                });
            });
            return points;
        }

        //Llenado de puntos evolutivo
        function reporteEvolutivo(data) {
            var points = [];
            $.each(data, function(i, item) {
                points.push({
                    x: new Date(item.departured_at),
                    y: parseInt(item.weight)
                });
            });
            return points;
        }

        //Grafica evolución de exportaciones
        function graficoEvolutivo(chartName, valueFormat, intervalType, points) {
            var chart, minimum = new Date($('#numMes').val().substr(0,4) + '/'+ $('#numMes').val().substr(4,2) + '/01');
            if (ptosCmp.length) {
                var cmp_ini = new Date(ptosCmp[0].start_at);
                var cmp_fin = new Date(ptosCmp[0].end_at);
                cmp_fin.setFullYear(cmp_fin.getFullYear() - (cmp_fin < cmp_ini ? 1 : 0));
                var str_ini = 'Inicio de campaña ' + cmp_ini.getFullYear() + ': ' + ('00' + cmp_ini.getDate()).slice(-2) + ' ' + months[cmp_ini.getMonth()];
                var str_fin = 'Fin de campaña ' + cmp_fin.getFullYear() + ': ' + ('00' + cmp_fin.getDate()).slice(-2) + ' ' + months[cmp_fin.getMonth()];
                chart = new CanvasJS.Chart(chartName, {
                    width: $('.tamano').width(),
                    theme: theme,
                    culture: cult,
                    animationEnabled: true,
                    axisX: {
                        minimum: minimum,
                        includeZero: false,
                        valueFormatString: valueFormat,
                        intervalType: intervalType,
                        stripLines: [{
                            value: ptosCmp[0].start_at,
                            thickness: 2,
                            label: str_ini,
                            color: fontColor,
                            labelFontColor: fontColor,
                            lineDashType: dashType,
                            labelFontSize: 14,
                            labelPlacement: placement
                        },{
                            value: ptosCmp[0].end_at,
                            thickness: 2,
                            label: str_fin,
                            color: fontColor,
                            labelFontColor: fontColor,
                            lineDashType: dashType,
                            labelFontSize: 14,
                            labelPlacement: placement
                        }]
                    },
                    data: [{
                        type: $('#slt-chart').val(),
                        color: lineColor,
                        dataPoints: points,
                        toolTipContent: toolTip
                    }]
                });
            }
            else {
                chart = new CanvasJS.Chart(chartName, {
                    width: $('.tamano').width(),
                    theme: theme,
                    culture: cult,
                    animationEnabled: true,
                    axisX: {
                        minimum: minimum,
                        includeZero: false,
                        valueFormatString: valueFormat,
                        intervalType: intervalType
                    },
                    data: [{
                        type: $('#slt-chart').val(),
                        color: lineColor,
                        dataPoints: points,
                        toolTipContent: toolTip
                    }]
                });
            }
            return chart.render();
        }

        //Efecto desplasado pantalla
        function mostrarAnimacion() {
            var pos = $('#tab').offset().top;
            $('html, body').animate({
                scrollTop: pos
            }, 1000);
        }

        //Grafica países importadores
        function reportePaises(mesIni, mesFin) {
            $('#titlePaisMes').empty();
            $('#sbTtlPaisMes').empty();
            $('#chartPaisMes').empty();
            $('#rsltdPaisMes').text(msgGenDat);
            $('#contPaisMes').css('background-color','#F6F2E9');
            $.ajax({
                type: 'get',
                url: 'manifests.dataPais',
                data: {'product_id':product_id,'mesIni':mesIni,'mesFin':mesFin},
                success: function(json) {
                    $('#titlePaisMes').text("Principales países importadores de " + prodNm);
                    $('#sbTtlPaisMes').text("Participación" + (mesIni != mesFin ? 
                                            " desde " + months[mesIni % 100 - 1] + " " + parseInt(mesIni / 100) + 
                                            " hasta " + months[mesFin % 100 - 1] + " " + parseInt(mesFin / 100) :
                                            " durante " + months[mesIni % 100 - 1] + " " + parseInt(mesFin / 100)));
                    var data = $.parseJSON(json);
                    if (data.length) {
                        $('#chartPaisMes').css({'height': 300});
                        var paisMes = [];
                        $.each(data, function(i, item) {
                            paisMes.push({
                                label: item.country,
                                y: parseFloat(item.participation)
                            });
                        });
                        var chartPaisMes = new CanvasJS.Chart("chartPaisMes", {
                            animationEnabled: true,
                            data: [{
                                type: "pie",
                                startAngle: 240,
                                yValueFormatString: "##0.00\"%\"",
                                indexLabel: "{label} {y}",
                                showInLegend: true,
                                legendText: "{label}",
                                indexLabelFontSize: 14,
                                dataPoints: paisMes
                            }]
                        });
                        chartPaisMes.render();
                        $('#rsltdPaisMes').text('');
                        $('#chartPaisMes').css('display','block');
                    } else {
                        $('#rsltdPaisMes').text(msgNotDat);
                        $('#chartPaisMes').css('display','none');
                    }
                    $('#contPaisMes').css('background-color','#fff');
                },
                error: function (msg) {
                    alert(msg.responseJSON['message']);
                }
            });
        }
        
        //Grafica empresas exportadoras
        function reporteExport(mesIni, mesFin) {
            $('#titleExpoMes').empty();
            $('#sbTtlExpoMes').empty();
            $('#tableExpoMes').empty();
            $('#rsltdExpoMes').text(msgGenDat);
            $('#contExpoMes').css('background-color','#F6F2E9');
            $.ajax({
                type: "get",
                url: "manifests.dataExpo",
                data: {'product_id':product_id,'mesIni':mesIni,'mesFin':mesFin},
                success: function(json) {
                    $('#titleExpoMes').text("Principales empresas exportadoras de " + prodNm);
                    $('#sbTtlExpoMes').text("Participación" + (mesIni != mesFin ? 
                                            " desde " + months[mesIni % 100 - 1] + " " + parseInt(mesIni / 100) + 
                                            " hasta " + months[mesFin % 100 - 1] + " " + parseInt(mesFin / 100) :
                                            " durante " + months[mesIni % 100 - 1] + " " + parseInt(mesFin / 100)));
                    $('#tableExpoMes').append(
                        '<thead>' +
                            '<tr>' +
                                '<th width="50%">Exportador</th>' +
                                '<th width="25%">Volumen (T)</th>' +
                                '<th width="25%">Participación</th>' +
                            '</tr>' +
                        '</thead>' +
                        '<tbody></tbody>'
                    );
                    var data = $.parseJSON(json);
                    if (data.length) {
                        $.each(data, function(i, item) {
                            $('#tableExpoMes tbody').append(
                                '<tr>' +
                                    '<td>' + item.shipper + '</td>' +
                                    '<td style="text-align:right">' + parseInt(item.weight).toLocaleString('en-US') + '</td>' +
                                    '<td style="text-align:right">' + parseFloat(item.participation).toFixed(2) + '%</td>' +
                                '</tr>'
                            );
                        });
                        $('#rsltdExpoMes').text('');
                        $('#tableExpoMes').css('display','block');
                    } else {
                        $('#rsltdExpoMes').text(msgNotDat);
                        $('#tableExpoMes').css('display','none');
                    }
                    $('#contExpoMes').css('background-color','#fff');
                },
                error: function (msg) {
                    alert(msg.responseJSON['message']);
                }
            });
        }

        //Carga de sliders de meses
        function cargarSlider(name, func) {
            var slider = [];
            var actDia = new Date();
            var actMes = actDia.getMonth();
            var actAno = actDia.getFullYear();

            for (var i=actMes; i<11; i++)
                slider.push(parseInt((actAno - 1) + ('00' + (i + 1)).slice(-2)));
            for (var i=0; i<actMes; i++)
                slider.push(parseInt((actAno) + ('00' + (i + 1)).slice(-2)));
            
            $('#'+name).ionRangeSlider({
                skin: 'modern',
                type: 'double',
                grid: true,
                step: 1,
                from: 0,
                to: 11,
                values: slider,
                prettify: function (num) {
                    return shortMonths[num % 100 - 1] + ' ' + parseInt(num / 100);
                },
                onStart: function (data) {
                    func(data.from_value, data.to_value);
                },
                onFinish: function (data) {
                    func(data.from_value, data.to_value);
                }
            });
        }

        //Cambio de mes de inicio
        $('#numMes').change(function() {
            var numMes = $('#numMes').val();

            //Datos evolución diaria
            $.ajax({
                type: "get",
                url: "manifests.dataEvolDia",
                data: {'product_id':product_id,'numMes':numMes},
                success: function(data) {
                    evolDia = reporteEvolutivo($.parseJSON(data));
                    charDia = graficoEvolutivo('chartEvolDia','DD MMM YY','day',evolDia);
                },
                error: function (msg) {
                    alert(msg.responseJSON['message']);
                }
            });
            //Datos evolución semanal
            $.ajax({
                type: "get",
                url: "manifests.dataEvolSem",
                data: {'product_id':product_id,'numMes':numMes},
                success: function(data) {
                    evolSem = reporteEvolutivo($.parseJSON(data));
                    charSem = graficoEvolutivo('chartEvolSem','DD MMM YY','week',evolSem);
                },
                error: function (msg) {
                    alert(msg.responseJSON['message']);
                }
            });
            //Datos evolución mensual
            $.ajax({
                type: "get",
                url: "manifests.dataEvolMes",
                data: {'product_id':product_id,'numMes':numMes},
                success: function(data) {
                    evolMes = reporteEvolutivo($.parseJSON(data));
                    charMes = graficoEvolutivo('chartEvolMes','MMMM YYYY','month',evolMes);
                },
                error: function (msg) {
                    alert(msg.responseJSON['message']);
                }
            });
            mostrarAnimacion();
        });

        //Cambio de tipo de gráfico
        $('#slt-chart').change(function() {
            charDia = graficoEvolutivo('chartEvolDia','DD MMM YY','day',evolDia);
            charSem = graficoEvolutivo('chartEvolSem','DD MMM YY','week',evolSem);
            charMes = graficoEvolutivo('chartEvolMes','MMMM YYYY','month',evolMes);
            mostrarAnimacion();
        });

        //Cambio de dimensión de pantalla
        $(window).resize(function() {
            charDia = graficoEvolutivo('chartEvolDia','DD MMM YY','day',evolDia);
            charSem = graficoEvolutivo('chartEvolSem','DD MMM YY','week',evolSem);
            charMes = graficoEvolutivo('chartEvolMes','MMMM YYYY','month',evolMes);
        });
    });
    </script>
</body>
</html>