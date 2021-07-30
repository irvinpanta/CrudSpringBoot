
function obtenerRadioVal() {

    //let valor = document.querySelector('input[name="requiere"]:checked').value
    var v1 = document.getElementById('rbtn_efectivo');
    var v2 = document.getElementById('rbtn_numoperacion');

    if (v1.checked){
        $("#valEfectivo").val(1);
        $("#valNumOpera").val(0);
    }

    if (v2.checked){
        $("#valEfectivo").val(0);
        $("#valNumOpera").val(1);
    }   
}


function getElemento(Nombre) {
    return document.getElementById(Nombre);
}

function sweetalertAlertaIcono(titulo,mensaje,icono) {
    Swal.fire(
      titulo,
      mensaje,
      'warning'
  )
}


function sweetAlertSuccessTime(msg = '', time = 3000){
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: time,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: msg
    })

    return true;
}

function sweetAlertErrorTime(msg, time = 2000){
	let timerInterval
    return Swal.fire({
        allowOutsideClick: false,
        icon: 'error',
    	title: msg,
        timer: time,
        timerProgressBar: true,
        
        didOpen: () => {
          Swal.showLoading()
            timerInterval = setInterval(() => {
              const content = Swal.getContent()
                if (content) {
                  const b = content.querySelector('b')
                  if (b) {
                    b.textContent = Swal.getTimerLeft()
                  }
                }
            }, 100)
          },
                            
          willClose: () => {
            clearInterval(timerInterval)
          }
        })
}

function gValidarEmail(email) {
    /*if (gTrim(email)!=""){*/
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)) {
        Swal.fire('La dirección de email es incorrecta.',
                '',
                'warning'
                );
        return false;
    }
    /*}*/
    return true;
}

function gKeyAceptaSoloTelefono(evt) {
    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;
    return (key <= 13 || (key >= 48 && key <= 57) || key == 45 || key == 35 || key == 42);
}

function gKeyAceptaSoloEmail(evt) {

    var key = ('charCode' in evt) ? evt.charCode : evt.keyCode;

    return (key <= 13 || (key >= 48 && key <= 57) || (key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key == 45 || key == 64 || key == 95 || key == 46);
}

function gKeyEnter(evt) {
    var key = 0;
    var arr = gBrowser();

    if (arr[0] == 'explorer' && arr[1] <= '8.0') {
        key = (window.event) ? event.keyCode : event.which;
    } else {
        key = ('charCode' in evt) ? evt.which : evt.keyCode;
    }
    return (key == 13);
}

function gBrowser() {

    var response = new Array('desconocido', '0');

    var is_safari = navigator.userAgent.toLowerCase().indexOf('safari/') > -1;
    var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome/') > -1;
    var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox/') > -1;
    var is_ie = navigator.userAgent.toLowerCase().indexOf('msie ') > -1;

    /* Detectando  si es Safari, vereis que en esta condicion preguntaremos por chrome ademas, esto es porque el
     la cadena de texto userAgent de Safari es un poco especial y muy parecida a chrome debido a que los dos navegadores
     usan webkit. */

    if (is_safari && !is_chrome) {
        /* Buscamos la cadena 'Version' para obtener su posicion en la cadena de texto, para ello
         utilizaremos la funcion, tolowercase() e indexof() que explicamos anteriormente */
        var posicion = navigator.userAgent.toLowerCase().indexOf('Version/');

        /* Una vez que tenemos la posición de la cadena de texto que indica la version capturamos la
         subcadena con substring(), como son 4 caracteres los obtendremos de 9 al 12 que es donde
         acaba la palabra 'version'. Tambien podraimos obtener la version con navigator.appVersion, pero
         la gran mayoria de las veces no es la version correcta. */
        var ver_safari = navigator.userAgent.toLowerCase().substring(posicion + 9, posicion + 12);

        // Convertimos la cadena de texto a float y mostramos la version y el navegador
        ver_safari = parseFloat(ver_safari);

        response = Array('safari', ver_safari);
        //alert('Su navegador es Safari, Version: ' + ver_safari);
    }

    //Detectando si es Chrome
    if (is_chrome) {
        var posicion = navigator.userAgent.toLowerCase().indexOf('chrome/');
        var ver_chrome = navigator.userAgent.toLowerCase().substring(posicion + 7, posicion + 11);
        //Comprobar version
        ver_chrome = parseFloat(ver_chrome);
        response = Array('chrome', ver_chrome);
    }

    //Detectando si es Firefox
    if (is_firefox) {
        var posicion = navigator.userAgent.toLowerCase().lastIndexOf('firefox/');
        var ver_firefox = navigator.userAgent.toLowerCase().substring(posicion + 8, posicion + 12);
        //Comprobar version
        ver_firefox = parseFloat(ver_firefox);
        response = Array('firefox', ver_firefox);
    }

    //Detectando Cualquier version de IE
    if (is_ie) {
        var posicion = navigator.userAgent.toLowerCase().lastIndexOf('msie ');
        var ver_ie = navigator.userAgent.toLowerCase().substring(posicion + 5, posicion + 8);
        //Comprobar version
        ver_chrome = parseFloat(ver_ie);
        response = Array('explorer', ver_ie);
    }

    return response;
}

function resetearFormulario($form){
  return $('#'+$form)[0].reset();
}

