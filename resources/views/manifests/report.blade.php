@extends('layouts.app')
@section('content')
<div class="fila">
    <div class="columna columna-1">
        <div class="title2">
            <h6>{{ __('Generador clásico de reportes - Datos actualizados al ') }} {{ Carbon\Carbon::parse($maxDate ?? '')->format('d/m/Y') }}</h6>
        </div>
    </div>
</div>
<form method="GET" action="{{ route('manifests.generate') }}">
    <input type="hidden" id="aux-country_id" value="{{ $country_id }}">
    <input type="hidden" id="aux-shipper_id" value="{{ $shipper_id }}">
    <input type="hidden" id="aux-consignee_id" value="{{ $consignee_id }}">
    <div class="fila">
        <div class="columna columna-4">
            <label>{{ __('Producto') }}</label>
            @inject('products','App\Services\Products')
            <select id="product_id" name="product_id">
                @foreach ($products->get() as $index => $product)
                <option value="{{ $index }}" {{ old('product_id',$product_id) == $index ? 'selected' : '' }}>
                    {{ $product }}
                </option>
                @endforeach
            </select>					
        </div>
        <div class="columna columna-4">
            <label>{{ __('País destino') }}</label>
            <select id="country_id" name="country_id"></select>					
        </div>
        <div class="columna columna-4">
            <label>{{ __('Exportador') }}</label>
            <select id="shipper_id" name="shipper_id"></select>					
        </div>
        <div class="columna columna-4">
            <label>{{ __('Consignatario') }}</label>
            <select id="consignee_id" name="consignee_id"></select>					
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-4">
            <label>{{ __('Detalle*') }}</label>
            <select id="detail" name="detail">
                <option value="Diario" {{ old('detail',$detail) == 'Diario' ? 'selected' : '' }}>{{ __('Diario') }}</option>
                <option value="Semanal" {{ old('detail',$detail) == 'Semanal' ? 'selected' : '' }}>{{ __('Semanal') }}</option>
                <option value="Mensual" {{ old('detail',$detail) == 'Mensual' ? 'selected' : '' }}>{{ __('Mensual') }}</option>
                <option value="Anual" {{ old('detail',$detail) == 'Anual' ? 'selected' : '' }}>{{ __('Anual') }}</option>
            </select>
        </div>
        <div class="columna columna-4">
            <label>{{ __('Fecha inicial*') }}</label>
            <input type="date" id="start_at" name="start_at" value="{{ old('start_at',Carbon\Carbon::parse($start_at)->toDateString()) }}" min="{{ Carbon\Carbon::parse($minDate)->toDateString() }}" max="{{ Carbon\Carbon::parse($maxDate)->toDateString() }}" required>
        </div>
        <div class="columna columna-4">
            <label>{{ __('Fecha final*') }}</label>
            <input type="date" id="end_at" name="end_at" value="{{ old('end_at',Carbon\Carbon::parse($end_at)->toDateString()) }}" min="{{ Carbon\Carbon::parse($minDate)->toDateString() }}" max="{{ Carbon\Carbon::parse($maxDate)->toDateString() }}" required>
        </div>
    </div>
    <div class="fila">
        <div class="columna columna-4"><br></div>
        <div class="columna columna-4">
            <button type="submit" class="btn-effie" style="width:100%;margin:16px 0px">{{ __('Generar') }}</button>
        </div>
        <div class="columna columna-4">
            <a href="{{ route('home') }}" class="btn-effie-inv" style="width:100%;margin:16px 0px;text-align:center">{{ Auth::user()->is_admin ? __('Regresar') : __('Limpiar') }}</a>
        </div>
    </div>
</form>
<div class="fila">
    <div class="columna columna-1">
        <p>
            <i class="fa fa-info-circle fa-icon" aria-hidden="true"></i>&nbsp;
            <b>Importante</b>
            <ul>
                <li>(*) Campos obligatorios.</li>
                <li>En caso que la cantidad de períodos obtenidos en el reporte sea mayor a treinta (30) se descargará automáticamente en formato excel.</li>
            </ul>
        </p>
    </div>
</div>
<div class="fila">
    <div class="columna columna-1">
        <div class="space"></div>
        <h6 class="title3">{{ $title }}</h6>
        <table id="tbl-report" class="tablereporte">
            <thead>
                <th></th>
                <th></th>
                <th width="80%">{{ __('País destino > Exportador > Consignatario') }}</th>
                @switch($detail)
                    @case('Anual')
                        @foreach($dates as $date)
                        <th>{{ $date['detail'] }}</th>
                        @endforeach
                        @break
                    @case('Mensual')
                        @php(setlocale(LC_ALL, 'es_ES'))
                        @foreach($dates as $date)
                        <th>{{ ucfirst(Carbon\Carbon::parse($date['detail'])->formatLocalized('%B %Y')) }}</th>
                        @endforeach
                        @break
                    @case('Semanal')
                        @foreach($dates as $date)
                        <th>{{ 'Sem'.substr($date['detail'],4,2).' '.substr($date['detail'],0,4) }}</th>
                        @endforeach
                        @break
                    @default
                        @foreach($dates as $date)
                        <th>{{ Carbon\Carbon::parse($date['detail'])->format('d/m/Y') }}</th>
                        @endforeach
                @endswitch
                <th>{{ __('Volumen total') }}</th>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item['country'] }}</td>
                    <td>{{ $item['shipper'] }}</td>
                    <td>{{ $item['consignee'] }}</td>
                    @foreach($dates as $date)
                    <td class="number">{{ $item[$date['detail']] ? number_format($item[$date['detail']]) : '-'}}</td>
                    @endforeach
                    <td class="number"><strong>{{ number_format($item['total']) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>
<script src="{{ asset('js/filters2.js') }}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

$(function() {
    if (@json($download ?? false)) {
        $.ajax({
            type: 'get',
            url: 'manifests.download',
            success: function () {
                alert('Debido al tamaño del reporte obtenido, este será descargado en formato excel. Por favor, verifique el inicio de la descarga en la parte inferior del navegador.');
            },
            error: function (msg) {
                alert(msg.responseJSON['message']);
            }
        });
    }
    var collapsedGroups = {};
    var num = @json(count($dates ?? []));
    var table = $('#tbl-report').DataTable({
        language: {
            'decimal': '',
            'emptyTable': 'No hay información para mostrar.',
            'info': 'Mostrando _START_ a _END_ de _TOTAL_ entradas',
            'infoEmpty': 'Mostrando 0 to 0 of 0 entradas',
            'infoFiltered': '(Filtrado de _MAX_ total entradas)',
            'infoPostFix': '',
            'thousands': ',',
            'lengthMenu': 'Mostrar _MENU_ entradas',
            'loadingRecords': 'Cargando...',
            'processing': 'Procesando...',
            'search': 'Buscar ',
            'zeroRecords': 'Sin resultados encontrados',
            'paginate': {
                'first': 'Primero',
                'last': 'Último',
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        },
        ordering: false,
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            // Uses the 'row group' plugin
            dataSrc: [0, 1],
            startRender: function (rows, group, column) {
                var collapsed = !!collapsedGroups[group];

                rows.nodes().each(function (r) {
                    r.style.display = collapsed ? 'none' : '';
                });
                var volumen = rows
                    .data()
                    .pluck(num + 3)
                    .reduce( function ( a, b ) {
                        return a + b.replace(/[^\d]/g, '')*1;
                    }, 0);
                // Add category name to the <tr>. NOTE: Hardcoded colspan
                if (column)
                    return $('<tr/>')
                        .append('<td colspan=' + (num + 1) + '>' + group + '</td>')
                        .append('<td class="number"><strong>' + volumen.toLocaleString('en-US') + '</strong></td>')
                        .css({'color':'#5AB248','font-size':'18px'})
                        .attr('data-name', group)
                        .toggleClass('collapsed', collapsed);
                else
                    return $('<tr/>')
                        .append('<td colspan=' + (num + 2) + '>' + group)
                        .attr('data-name', group)
                        .toggleClass('collapsed', collapsed);
            }
        },
        columnDefs: [{
            targets: [0, 1],
            visible: false
        }]
    });

    $('#tbl-report tbody tr.group-start').each(function () {
        var name = $(this).data('name');
        collapsedGroups[name] = !collapsedGroups[name];
    });
    table.draw(false);

    $('#tbl-report tbody').on('click', 'tr.group-start', function () {
        var name = $(this).data('name');
        collapsedGroups[name] = !collapsedGroups[name];
        table.draw(false);
    });
});
</script>
@endsection