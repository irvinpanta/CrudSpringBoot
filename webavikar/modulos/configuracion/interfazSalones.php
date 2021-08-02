<?php 

require_once(APP_DIR_CLASS . 'configuracion/men_salon.class.php');

class InterfazSalones
{
	
	function interfazPrincipal(){

		$titulo = 'Configuración de Salones';

		$html = '<ul class="breadcrumb">                            
                    <li>
                    	<a href="'. APP_INDEX .'" style="color: orangered;">Inicio</a><span class="divider">&raquo;</span>
                    </li>
                    <li>'.$titulo.'</li>
                </ul>

                <div id="ajaxFormulario"></div>
                ';

        $html .='<div class="well form-inline">
                           
                    <div class="nonboxy-widget ">
                                
                        <div class="widget-head">
                            <h5 class="pull-left"><i class="black-icons list_images"></i>'.$titulo.'</h5>
                        </div> 

                        <button id="btnNuevo" class="btn btn-secondary">
                            <i class="icon-plus-sign"></i>Nuevo
                        </button>

                        <br><br>

                        <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                                <div class="table-responsive">

                                    <table class="table table-striped table-bordered table-condensed table-hover">

                                        <thead>
                                            <tr>
                                                <th style="width: 1%; text-align: center">Nro.</th>
                                                <th style="width: 1%; text-align: center" colspan=""></th>
                                                <th style="width: 1%; text-align: center" colspan=""></th>
                                                <th style="width: 1%; text-align: center">Codigo</th>
                                                <th style="width: 180px; text-align: center">Salon</th>
                                                <th style="width: 10%; text-align: center">Capacidad</th>
                                                <th style="width: 6%; text-align: center">Estado</th>
                                            </tr>
                                        </thead>

                 	                    <tbody id="td_listado">
                 	                    '.$this->interfazListado().'
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>';

		return $html;
	}

    function interfazListado(){

        $html = '';
        $contador = 0;

        $obj = new MenSalon();
        $response = $obj->consultarSalon(1);
        $datos = json_decode($response, true);

        if ($response == "1"){  
            $html = showEror($obj->getMsgErr()); 
        }else{
      
            foreach ($datos as $key => $value) {

                if ($value['activo'] == '1'){
                    $estado = "Activo";
                    $color = "label label-success";
                }else{
                    $estado = "Inactivo";
                    $color = "label label-warning";
                }
                
                $html .= '

                <tr>
                    <td style="text-align: center">' . (++$contador) . '</td> 

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazSalonesFormulario(\''.$value['salon'].'\');
                        "><i class="color-icons icons_editar"></i>
                        </a>                       
                    </td>

                    <td style="text-align: center;">
                        <a title = "'.MSG_0011.'" href = javascript:void(0) 
                        onclick="

                            Swal.fire({
                              allowOutsideClick: false,
                              title: \''.MSG_0020.'\',
                              text: \''.$value['descripcion'].'\',
                              icon: \'question\',
                              showCancelButton: true,
                              confirmButtonColor: \'#3085d6\',
                              cancelButtonColor: \'#d33\',
                              confirmButtonText: \'Si, Eliminar registro!\'
                              }).then((result) => {
                                  if (result.isConfirmed) {
                                      xajax__InterfazSalonesMantenimiento(\'3\',\''.$value['salon'].'\')
                                  }
                            })

                      ">
                      <i class="color-icons icons_delete"></i>
                      </a>
                    </td>
                    <td style="text-align: center">'.$value['salon'].'</td>
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                    <td style="text-align: center">'.$value['capacidad'].'</td>
                    <td style="text-align: center"><span class="'.$color.'">'.$estado.'</span></td>
                </tr>';
            }

        }
        return $html;
    }

    function formulariosalon($salon=''){

        $html = '

        <div class="modal" id="modal-default" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Configuración de salones</h4>
                    </div>  

                    <div class="modal-body">
                        <form id="formsalon" name="formsalon" onSubmit="return false" onkeypress="if(gKeyEnter(event)) return false;">

                            <div class="well-login">
        
                                <input type="hidden" id="idSalon" name="idSalon" value="'.$salon.'">

                                <div class="form-group">
                                    <label>Descripcion:</label>
                                    <input type="text" id="txt_descripcion_salon" name="txt_descripcion_salon" class="form-control" placeholder="Descripcion">
                                </div>

                                <div class="form-group">
                                    <label>Capacidad:</label>
                                    <input type="text" id="txt_capacidad_salon" name="txt_capacidad_salon" class="form-control" placeholder="Capacidad">
                                </div>

                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 20px;">
                                        <input type="checkbox" id="chk_activo_salon" name="chk_activo_salon" value="1" checked>Activo.
                                    </label>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button id="btnGrabar" type="button" class="btn btn-primary pull-left">
                            <i class="icon-ok icon-white"></i><span>Guardar</span>
                        </button>

                        <button data-dismiss="modal" type="button" class="btn pull-left">
                            <i class="icon-remove"></i>Cerrar
                        </button> 

                        <span class="CampoObligatorio">(*) Campos Obligatorios</span> 
                    </div>

                </div>
            </div>
        </div>';

        return $html;
    }

}


function _InterfazSalonesPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazSalones();
    $html = $objIn->interfazPrincipal();

	$rpta->addScript('
		$(document).ready(function(){
    		$(".table").DataTable();
  		});'
  	);

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    $rpta->addScript("
        $('#btnNuevo').unbind('click').click(function(){
            xajax__InterfazSalonesFormulario();
        });
    ");

	return $rpta;
}

function _interfazsalonListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazSalones();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazSalonesFormulario($salon = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazSalones();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formulariosalon($salon));
    
    $obj = new MenSalon();
    $response = $obj->consultarSalon(2, $salon);
    $resultado = json_decode($response, true);


    if ($response !== "salon no existe"){
    
        if ($salon == ""){

            $rpta->addAssign("formTitle01",'innerHTML',"Nuevo salon");
            $rpta->addAssign("btnGrabar",'innerHTML',"Guardar");

        }else{

            $rpta->addAssign("formTitle01",'innerHTML',"Editar salon");
            $rpta->addAssign("btnGrabar",'innerHTML',"Actualizar");

       
            $rpta->addAssign("txt_descripcion_salon","value",$resultado["descripcion"]);
            $rpta->addAssign("txt_capacidad_salon","value",$resultado["capacidad"]);

            if ($resultado["activo"] == 1) {
                
                $rpta->addScript("
                    $('#chk_activo_salon').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#chk_activo_salon').prop('checked',false);
                ");
            }
        }

        $rpta->addScript("

            $('#btnGrabar').unbind('click').click(function(){
                validaERP.valida({
                    form: '#formsalon',
                    items: {
                        txt_descripcion_salon: {
                            required: true
                        },
                        txt_capacidad_salon: {
                            required: true,
                            number: true
                        }
                    },
                    success: function() {
                        var xFlag = $('#btnGrabar').html() == 'Guardar' ? '1' : '2';
                        xajax__InterfazSalonesMantenimiento(xFlag, xajax.getFormValues('formsalon', true));
                    }
                });
            });

            $('#modal-default').modal('show');
            $('#txt_descripcion_salon').focus();
        ");

    }else{
        $rpta->addAlert("salon no existe");
    }

    return $rpta;
}

function _InterfazSalonesMantenimiento($xFlag, $xForm){

    $rpta = new xajaxResponse();

    $objR = new MenSalon();
    $resul = $objR->mantenimientoData($xFlag, $xForm);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            xajax__interfazsalonListado();
                $('#modal-default').modal('hide');
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazSalonesPrincipal");
$xajax->registerFunction("_interfazsalonListado");
$xajax->registerFunction("_InterfazSalonesFormulario");
$xajax->registerFunction("_InterfazSalonesMantenimiento");

?>
