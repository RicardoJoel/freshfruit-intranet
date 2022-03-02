$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
    }
});

$(function() {
    var showChar = 0;
    var ellipsestext = '';
    var moretext = 'Mostrar indicaciones';
    var lesstext = 'Ocultar indicaciones';
    var content = $('.more').html();
    
    if(content.length > showChar) {
        var c = content.substr(0, showChar);
        var html = '<div class="abstract">' + c + ellipsestext + '</div>' + '<div class="morecontent">' + content + '</div>' + '<p><span class="morelink">' + moretext + '</span></p>';
        $('.more').html(html);
    }
        
    $('.morelink').click(function() {
        if($(this).hasClass('less')) {
            $(this).removeClass('less');
            $(this).html(moretext);
            $('.abstract').removeClass('hidden');
        } else {
            $(this).addClass('less');
                $(this).html(lesstext);
                $('.abstract').addClass('hidden');
        }
        $(this).parent().prev().slideToggle('fast');
        $(this).prev().slideToggle('fast');
            return false;
    });
});
