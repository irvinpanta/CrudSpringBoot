<script>
var validaERP_ = function(){
    
    var _private = {};
    
    _private.isDate = function(txtDate) {
        var currVal = txtDate;
        if (currVal == '')
            return false;

        //Declare Regex 
        var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
        var dtArray = currVal.match(rxDatePattern); // is format OK?

        if (dtArray == null)
            return false;

        var dtDay = dtArray[1];
        var dtMonth = dtArray[3];
        var dtYear = dtArray[5];
        if (dtMonth < 1 || dtMonth > 12)
            return false;
        else if (dtDay < 1 || dtDay > 31)
            return false;
        else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
            return false;
        else if (dtMonth == 2)
        {
            var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
            if (dtDay > 29 || (dtDay == 29 && !isleap))
                return false;
        }
        return true;
    };
    
    _private.isHora = function(textHora){
        var valorActual = textHora;
        
        if (valorActual == '')
            return false;
        
        var rxHoraPattern = /^(\d{2})(:)(\d{2})$/;
        var hrArray = valorActual.match(rxHoraPattern); // is format OK?
        
        var hrHora = hrArray[1];
        var hrMin = hrArray[3];
        
        if (hrHora > 23)
            return "H";
        
        if (hrMin > 59)
            return "M";
        
        
        return "T";

     
     
      
    };
    
    
    _private.mesagge =  function(form,el,elementName,msn,inp,autocomplete){
            var xleft = parseInt($(el).position().left) - 35;      //left de elemento
            var xtop = parseInt($(el).position().top) + 28;   //top de elemento
            var xheight = parseInt($(el).css('height')); 

            if(elementName === 'checkbox' || elementName === 'radio'){
                xleft = parseInt($(inp).position().left) - 18;      //left de elemento
                xtop = parseInt($(inp).position().top) + 25;   //top de elemento
            }
            
            if(elementName === 'textarea'){
                xtop += xheight - 17;
            }
            
            if(elementName === 'chosen'){
                el = el+'_chzn';
            }
            
            if(elementName === 'chosen2'){
                el = el+'_chosen';
            }
            
            if(elementName === 'tree'){
                el = el+'_tree';
            }            
            
            if(autocomplete){
                el = el+'Criterio';
            }
            
            $(el).addClass('error');
            var span = $('<div class="xmsnErrorSpan" style="position:relative;"><span style="/*position:absolute;*/ color:#990000;">'+msn+'</span></div>');
            
            //agrego nuevo span
            $(span).insertAfter(el);
           //$(span).css('display','block').delay(7000).fadeOut();
    };
    
    _private.validaReglas = function(obj,element,elementName){
        var required = eval('obj.items.'+element+'.required'),
            min = eval('obj.items.'+element+'.min'),    
            max = eval('obj.items.'+element+'.max'),
            minlength = eval('obj.items.'+element+'.minlength'),
            maxlength = eval('obj.items.'+element+'.maxlength'),
            rangelength = eval('obj.items.'+element+'.rangelength'),
            range = eval('obj.items.'+element+'.range'),
            email = eval('obj.items.'+element+'.email'),
            url = eval('obj.items.'+element+'.url'),
            date = eval('obj.items.'+element+'.date'),
            number = eval('obj.items.'+element+'.number'),
            digits = eval('obj.items.'+element+'.digits'),
            regular = eval('obj.items.'+element+'.regular'),
            regular2 = eval('obj.items.'+element+'.regular2'),
            regular3 = eval('obj.items.'+element+'.regular3'),
            regular4 = eval('obj.items.'+element+'.regular4'),
            regular5 = eval('obj.items.'+element+'.regular5'),
            regular6 = eval('obj.items.'+element+'.regular6'),
            regular_sgc = eval('obj.items.'+element+'.regular_sgc'),
            length = eval('obj.items.'+element+'.length'),
            length2 = eval('obj.items.'+element+'.length2'),
            chosen = eval('obj.items.'+element+'.chosen'),
            chosen2 = eval('obj.items.'+element+'.chosen2'),
            tree = eval('obj.items.'+element+'.tree'),
            autocomplete = eval('obj.items.'+element+'.autocomplete'),
            cadena = eval('obj.items.'+element+'.cadena'),
            img = eval('obj.items.'+element+'.img'),
            jpg = eval('obj.items.'+element+'.jpg'),
            hora    = eval('obj.items.'+element+'.hora'),
			requiredfile = eval('obj.items.'+element+'.requiredfile'), // Valida que se suba un archivo
			extensionfile = eval('obj.items.'+element+'.extensionfile'), // Valida la extension de un archivo, solo PDF 
            valor = $('#'+element).val(),
            msn = '',
            resp,
            error = 0,
            minl = 0,
            maxl = 0,
            reg = 0,
            req = 0,
            rang = 0;
          

        if(elementName === 'select' && required && chosen){
            resp = valor !== '' && valor !== '_none_';
            if(!resp){
                error = 1;
                req = 1;
                msn = '<?php echo MSG_0040; ?>';
            }
        } 
        
        if(elementName === 'select' && required && !chosen){
            resp = valor !== '' && valor !== '_none_';
            if(!resp){
                error = 1;
                req = 1;
                msn = '<?php echo MSG_0040; ?>';
            }
        }  
        
        
        if(required){
            resp = $.trim(valor).length > 0;
            if(!resp){
                error = 1;
                req = 1;
                msn = '<?php echo MSG_0040; ?>';
            }
        }
        if(min){
            if(valor < min && req==0){
                error = 1;
                msn = 'Ingrese un valor mayor o igual a '+min+'.';
            }
        }
        if(max){            
            if(valor > max && req==0){                
                error = 1;
                msn = 'Ingrese un valor menor o igual a '+max+'.';
            }
        }
        if(minlength){
            if($.trim(valor).length > 0 && valor.length < minlength){
                error = 1;
                minl = 1;
                msn = 'Ingrese un mínimo de '+minlength+' caracteres.';
            }
        }
        if(maxlength){
            if($.trim(valor).length > maxlength && valor.length > 0){
                error = 1;
                maxl = 1;
                msn = 'Ingrese un máximo de '+maxlength+' caracteres.';
            }
        }
        if(rangelength && $.isArray(rangelength)){
            resp = $.trim(valor).length >= rangelength[0] && $.trim(valor).length <= rangelength[1];
            if(!resp && maxl === 0 && minl === 0 && $.trim(valor).length > 0){
                error = 1;
                msn = 'Ingrese un valor entre '+rangelength[0]+' y '+rangelength[1]+' caracteres.';
            }
        }
        if(range && $.isArray(range)){
            resp = valor >= range[0] && valor <= range[1];
            if(!resp && $.trim(valor).length > 0){
                error = 1;
                msn = 'Ingrese un valor entre '+range[0]+' y '+range[1]+'.';
            }
        }
        if(email){
            resp = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(valor);
            if(!resp && $.trim(valor).length > 0 && maxl === 0 && minl === 0 && rang === 0){
                error = 1;
                msn = 'Ingrese un email válido.';
            }
        }
        if(url){
            resp = /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(valor);
            if(!resp && $.trim(valor).length > 0 && maxl === 0 && minl === 0 && rang === 0){
                error = 1;
                msn = 'Ingrese una URL válida.';
            }
        }
        if(date){
            //resp = !/Invalid|NaN/.test((new Date(valor)).toString());
            if(!_private.isDate(valor) && $.trim(valor).length > 0){
                error = 1;
                msn = 'Ingrese una fecha válida.';
            }
        }
        if(number){
            resp = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(valor);
            if(!resp && $.trim(valor).length > 0){
                error = 1;
                msn = 'Ingrese un número válido.';
            }
        }
        if(digits){
            resp = /^\d+$/.test(valor);
            if(!resp && $.trim(valor).length > 0){
                error = 1;
                msn = 'Ingrese solo dígitos.';
            }
        }
        if(regular){            
            resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=#,:;._ ¿?()°-]+$/.test(valor);
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_1033; ?>';
            }
        }
        if(regular2){
            //resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=_ -]+$/.test(valor);
            resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=#,:;._ -()¿?°-]+$/.test(valor);
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_1033; ?>';
            }
        }
        if(regular3){
            //resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=_ -()]+$/.test(valor);
            resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=#,:;._ -()¿?°-]+$/.test(valor);
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_1033; ?>';
            }
        }
        if(regular4){
            //resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=_ -/'"°()]+$/.test(valor);
            resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=#,:;._ -()¿?°-]+$/.test(valor);
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_1033; ?>';
            }
        }

        if(regular5){
            //resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=_ -/'"°()]+$/.test(valor);
            resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\n-\r\d=#,:;._ -()¿?"'°-]+$/.test(valor);
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_1033; ?>';
            }
        }
        
        if(regular6){
            //resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\d=_ -/'"°()]+$/.test(valor);
            resp = /^([A-Z]{1}[0-9]{1}|[A-Z]{2}|[0-9]{1}[A-Z]{1}|[0-9]{2})$/.test(valor.toUpperCase());
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_0040; ?>';
            }
        }

        if(regular_sgc){
            resp = /^[A-Za-záéíóúäëïöüñÁÉÍÓÚÑÄËÏÖÜ\n-\r\d=#,:;._ -()+¿?"'°%/-]+$/.test(valor);
            if(!resp && $.trim(valor).length > 0 && minl === 0 && maxl === 0){
                error = 1;
                reg = 1;
                msn = '<?php echo MSG_1033; ?>';
            }
        }
        
        if(cadena){
            if(!isNaN(valor)&&$.trim(valor).length > 0){
                error = 1;
                reg = 1;
                msn = 'No se permiten números.';
            }
        }
        if(length){
            resp = $.trim(valor).length === length;
            if(!resp && valor.length > 0){
                error = 1;
                msn = 'Ingrese '+length+' caracteres.';
            }
        }
        if(length2){
            resp = $.trim(valor).length == length2;
            if(!resp && valor.length > 0){
                error = 1;
                msn = 'Ingrese '+length2+' caracteres.';
            }
        }

        if(hora){
            
             switch (_private.isHora(valor)) {
                case "H":
                    error = 1;
                    msn = 'Ingresar una hora válida.';
                    break;
                case "M":
                    error = 1;
                    msn = 'Ingresar minutos válidos.';
                    break;
            }


        }
		
		if(requiredfile){ // Valida que se suba un archivo
            resp = $.trim(valor).length > 0;
            if(!resp){
                error = 1;
                req = 1;
                msn = 'Seleccione un archivo de máximo 8 MB.';
            }
        }
		
		if(extensionfile){ // Valida la extension de un archivo, solo PDF
			archivo = valor;
			extensiones_permitidas = new Array(".pdf");
			//recupero la extensiÃ³n de este nombre de archivo
			extensionfile = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
			//compruebo si la extensiÃ³n estÃ¡ entre las permitidas
			resp = false;
			for (var i = 0; i < extensiones_permitidas.length; i++){
				if (extensiones_permitidas[i] == extensionfile){
					resp = true;
					break;
				}
			}
			if(!resp){
				mierror = "solamente se permiten archivos de tipo:( " + extensiones_permitidas.join()+" )";
			}
			if(!resp && valor.length > 0){
                error = 1;
                msn = mierror;
            }
        }

        if(img){ // Valida la extension de un archivo, solo PDF
            archivo = valor;
            extensiones_permitidas = new Array(".jpg",".png",".gif");
            //recupero la extensiÃ³n de este nombre de archivo
            extensionfile = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
            //compruebo si la extensiÃ³n estÃ¡ entre las permitidas
            resp = false;
            for (var i = 0; i < extensiones_permitidas.length; i++){
                if (extensiones_permitidas[i] == extensionfile){
                    resp = true;
                    break;
                }
            }
            if(!resp){
                mierror = "solamente se permiten archivos de tipo:( " + extensiones_permitidas.join()+" )";
            }
            if(!resp && valor.length > 0){
                error = 1;
                msn = mierror;
            }
        }

        if(jpg){ // Valida la extension de un archivo, solo PDF
            archivo = valor;
            extensiones_permitidas = new Array(".jpg");
            //recupero la extensiÃ³n de este nombre de archivo
            extensionfile = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
            //compruebo si la extensiÃ³n estÃ¡ entre las permitidas
            resp = false;
            for (var i = 0; i < extensiones_permitidas.length; i++){
                if (extensiones_permitidas[i] == extensionfile){
                    resp = true;
                    break;
                }
            }
            if(!resp){
                mierror = "solamente se permiten archivos de tipo:( " + extensiones_permitidas.join()+" )";
            }
            if(!resp && valor.length > 0){
                error = 1;
                msn = mierror;
            }
        }

        if(chosen){
            elementName = 'chosen';
        }
        
        if(chosen2){
            elementName = 'chosen2';
        }
        
         if(tree){
            elementName = 'tree';
        }
        
        if(error === 1){
            _private.mesagge(obj.form,'#'+element,elementName,msn,'',autocomplete);
        }
        return error;
    };
    
    _private.getLength = function(obj,element,tipo,elementName){
        var required = eval('obj.items.'+element+'.required'),
            inp,
            error = 1,
            data;
        
        if(required){
            data = $('#'+element).find('input:'+tipo);
            $.each(data,function(){
                inp = $(this).attr('id');
                if($(this).is(':checked')){
                    error = 0;
                }
            });
        }
        if(error === 1){
            _private.mesagge(obj.form,'#'+element,tipo,'<?php echo MSG_0040; ?>','#'+inp);
        }
        return error;
    };
    
    this.public = {};
    
    this.public.valida = function(obj){
        var error1 = [], error2 = [], xerror1 = 0, xerror2 = 0;
        if(obj.form.length === 0){
            sweetalertAlertaIcono('','Formulario ['+obj.form+'] no existe.','info');
        }else{
            $(obj.form).find('.xmsnErrorSpan').remove();
            
            var encontre, objElement, element, valor, tipo, elementName;
            
            $.each(obj.items,function(index,value){
                encontre = 0;
                objElement = index;
                element = $('#'+objElement);
                tipo = element.attr('type');
                elementName = element[0].tagName.toLowerCase();
                
                /*validando los radios y checkbox */
                if(elementName === 'div' && (tipo === 'radio' || tipo === 'checkbox')){
                    element.removeClass('error');
                    $('#'+objElement+'_chzn').removeClass('error'); /*para los chosen*/
                    $('#'+objElement+'_chosen').removeClass('error'); /*para los chosen*/
                    $('#'+objElement+'_tree').removeClass('error'); /*para los tree*/
                    $('#'+objElement+'Criterio').removeClass('error'); /*para los autocompletar de erp*/
                    error1.push(_private.getLength(obj,objElement,tipo,elementName));
                }else{
                    element.removeClass('error');
                    $('#'+objElement+'_chzn').removeClass('error'); /*para los chosen*/
                    $('#'+objElement+'_chosen').removeClass('error'); /*para los chosen*/
                    $('#'+objElement+'_tree').removeClass('error'); /*para los tree*/
                    $('#'+objElement+'Criterio').removeClass('error'); /*para los autocompletar de erp*/
                    error2.push(_private.validaReglas(obj,objElement,elementName));
                }
            });
            
            
        }
        
        for(var i in error1){
            if(error1[i] === 1){
                xerror1 = 1;
            }
        }
        for(var i in error2){
            if(error2[i] === 1){
                xerror2 = 1;
            }
        }
        
        if(xerror1 === 0 && xerror2 === 0){
            obj.success();
        }else{
            if(obj.message !== undefined){
                sweetalertAlertaIcono('',obj.message,'warning');
            }else{
                sweetalertAlertaIcono('','Revise los campos marcados.','warning');
            }
        }
    };
    
    this.public.reset = function(form){
        $(form).find('.xmsnErrorSpan').remove();
        $(form).find('input, textarea, select, div').removeClass('error');
    };

    this.public.clearForm = function(form){
        $(form)[0].reset();
    };

    return this.public;
};

var validaERP = new validaERP_();
</script>