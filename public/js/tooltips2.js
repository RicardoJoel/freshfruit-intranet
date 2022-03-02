$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')     
  }
});

$(() => {
  new jBox('Tooltip', {
    attach: '#login_email',
    theme: 'TooltipDark',
    animation: 'zoomOut',
    position: {
      x: 'right',
      y: 'center'
    },
    width: 280,
    outside: 'x',
    content: 'Correo electrónico registrado en el sistema.',
  });

  new jBox('Tooltip', {
    attach: '#login_password',
    theme: 'TooltipDark',
    animation: 'zoomOut',
    position: {
      x: 'right',
      y: 'center'
    },
    width: 280,
    outside: 'x',
    content: 'De no recordarla, haga clic en "Olvidé mi contraseña".',
  });

  new jBox('Tooltip', {
    attach: '#new_password',
    theme: 'TooltipDark',
    animation: 'zoomOut',
    position: {
      x: 'right',
      y: 'center'
    },
    width: 280,
    outside: 'x',
    content: 'Entre 8 y 50 caracteres con, al menos, una letra y un dígito.',
  });

  new jBox('Tooltip', {
    attach: '#new_confirm_password',
    theme: 'TooltipDark',
    animation: 'zoomOut',
    position: {
      x: 'right',
      y: 'center'
    },
    width: 280,
    outside: 'x',
    content: 'Asegúrese que coincidan ambas contraseñas.',
  });

  new jBox('Tooltip', {
    attach: '#current_password',
    theme: 'TooltipDark',
    animation: 'zoomOut',
    position: {
      x: 'right',
      y: 'center'
    },
    width: 280,
    outside: 'x',
    content: 'Por seguridad, debe ingresar su contraseña actual.',
  });

});
