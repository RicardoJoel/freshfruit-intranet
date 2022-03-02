$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

$(function() {
    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'manifests.countries',
        data: {'product_id':$('#product_id').val()},
        success: (data) => {
            $('#country_id').empty();
            $('#country_id').append('<option selected value="">Todos los países</option>');
            $(JSON.parse(data)).each(function() {
                var option = $(document.createElement('option'));
                option.val(this.id);
                option.text(this.name);
                $('#country_id').append(option);
            });
            var aux = $('#aux-country_id').val();
            if (aux !== '') $('#country_id option[value=' + aux + ']').attr('selected', true);
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            alert(msg.responseJSON['message']);
            $('body').loadingModal('destroy');
        }
    });

    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'manifests.shippers',
        data: {'product_id':$('#product_id').val(),'country_id':$('#aux-country_id').val()},
        success: (data) => {
            $('#shipper_id').empty();
            $('#shipper_id').append('<option selected value="">Todos los exportadores</option>');
            $(JSON.parse(data)).each(function() {
                var option = $(document.createElement('option'));
                option.val(this.id);
                option.text(this.name);
                $('#shipper_id').append(option);
            });
            var aux = $('#aux-shipper_id').val();
            if (aux !== '') $('#shipper_id option[value=' + aux + ']').attr('selected', true);
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            alert(msg.responseJSON['message']);
            $('body').loadingModal('destroy');
        }
    });

    $('body').loadingModal({
        text:'Un momento, por favor...',
        animation:'wanderingCubes'
    });
    $.ajax({
        type: 'get',
        url: 'manifests.consignees',
        data: {'product_id':$('#product_id').val(),'country_id':$('#aux-country_id').val(),'shipper_id':$('#aux-shipper_id').val()},
        success: (data) => {
            $('#consignee_id').empty();
            $('#consignee_id').append('<option selected value="">Todos los consignatarios</option>');
            $(JSON.parse(data)).each(function() {
                var option = $(document.createElement('option'));
                option.val(this.id);
                option.text(this.name);
                $('#consignee_id').append(option);
            });
            var aux = $('#aux-consignee_id').val();
            if (aux !== '') $('#consignee_id option[value=' + aux + ']').attr('selected', true);
            $('body').loadingModal('destroy');
        },
        error: (msg) => {
            alert(msg.responseJSON['message']);
            $('body').loadingModal('destroy');
        }
    });

    $('#product_id').change(function() {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'manifests.countries',
            data: {'product_id':$('#product_id').val()},
            success: (data) => {
                $('#country_id').empty();
                $('#country_id').append('<option selected value="">Todos los países</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#country_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });

        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'manifests.shippers',
            data: {'product_id':$('#product_id').val()},
            success: (data) => {
                $('#shipper_id').empty();
                $('#shipper_id').append('<option selected value="">Todos los exportadores</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#shipper_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });

        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'manifests.consignees',
            data: {'product_id':$('#product_id').val()},
            success: (data) => {
                $('#consignee_id').empty();
                $('#consignee_id').append('<option selected value="">Todos los consignatarios</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#consignee_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });
    });

    $('#country_id').change(function() {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'manifests.shippers',
            data: {'product_id':$('#product_id').val(),'country_id':$('#country_id').val()},
            success: (data) => {
                $('#shipper_id').empty();
                $('#shipper_id').append('<option selected value="">Todos los exportadores</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#shipper_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });

        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'manifests.consignees',
            data: {'product_id':$('#product_id').val(),'country_id':$('#country_id').val()},
            success: (data) => {
                $('#consignee_id').empty();
                $('#consignee_id').append('<option selected value="">Todos los consignatarios</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#consignee_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });
    });

    $('#shipper_id').change(function() {
        $('body').loadingModal({
            text:'Un momento, por favor...',
            animation:'wanderingCubes'
        });
        $.ajax({
            type: 'get',
            url: 'manifests.consignees',
            data: {'product_id':$('#product_id').val(),'country_id':$('#country_id').val(),'shipper_id':$('#shipper_id').val()},
            success: (data) => {
                $('#consignee_id').empty();
                $('#consignee_id').append('<option selected value="">Todos los consignatarios</option>');
                $(JSON.parse(data)).each(function() {
                    var option = $(document.createElement('option'));
                    option.val(this.id);
                    option.text(this.name);
                    $('#consignee_id').append(option);
                });
                $('body').loadingModal('destroy');
            },
            error: (msg) => {
                alert(msg.responseJSON['message']);
                $('body').loadingModal('destroy');
            }
        });
    });
});