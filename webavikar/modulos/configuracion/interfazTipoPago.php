<?php 

require_once(APP_DIR_CLASS . 'configuracion/men_tipopago.class.php');

class InterfazTipoPago
{
    
    function interfazPrincipal(){

        $titulo = 'Configuración Tipo de Pago';

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
                                                <th style="width: 180px; text-align: center">Descripcion</th>
                                                <th style="width: 6%; text-align: center">Req. Efectivo</th>
                                                <th style="width: 6%; text-align: center">Req. Num. Operacion</th>
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

        $obj = new MenTipoP();
        $response = $obj->consultar(1);
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

                if ($value['requiereEfectivo'] == '1'){
                    $efectivo = "Si";
                    $colorE = "label label-success";
                }else{
                    $efectivo = "No";
                    $colorE = "label label-warning";
                }

                if ($value['requiereNumOperacion'] == '1'){
                    $opera = "Si";
                    $colorO = "label label-success";
                }else{
                    $opera = "No";
                    $colorO = "label label-warning";
                }


                
                $html .= '

                <tr>
                    <td style="text-align: center">' . (++$contador) . '</td> 

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazTipoPagoFormulario(\''.$value['tipoPago'].'\');
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
                                      xajax__InterfazTipoPagoMantenimiento(\'3\',\''.$value['tipoPago'].'\')
                                  }
                            })

                      ">
                      <i class="color-icons icons_delete"></i>
                      </a>
                    </td>
                    <td style="text-align: center">'.$value['tipoPago'].'</td>
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                    <td style="text-align: center"><span class="'.$colorE.'">'.$efectivo.'</span></td>
                    <td style="text-align: center"><span class="'.$colorO.'">'.$opera.'</span></td>
                    <td style="text-align: center"><span class="'.$color.'">'.$estado.'</span></td>
                </tr>';
            }

        }
        return $html;
    }

    function formulariotipopago($tipopago=''){

        $html = '

        <div class="modal" id="modal-default" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Configuración Tipo de Operacion</h4>
                    </div>  

                    <div class="modal-body">
                        <form id="formtipopago" name="formtipopago" onSubmit="return false" onkeypress="if(gKeyEnter(event)) return false;">

                            <div class="well-login">
        
                                <input type="hidden" id="id" name="id" value="'.$tipopago.'">
                                <input type="hidden" id="valEfectivo" name="valEfectivo" value="1">
                                <input type="hidden" id="valNumOpera" name="valNumOpera" value="0">

                                <div class="form-group">
                                    <label>Descripcion:</label>
                                    <input type="text" id="txt_descripcion" name="txt_descripcion" class="form-control" placeholder="Descripcion">
                                </div>

                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: ;">
                                        <input type="radio" id="rbtn_efectivo" name="requiere" onclick=obtenerRadioVal(); checked> Req. Efectivo.
                                    </label>
                                    <label class="checkbox" style="margin-left: ;">
                                        <input type="radio" id="rbtn_numoperacion" name="requiere" onclick=obtenerRadioVal();> Req. Num Operacion.
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 20px;">
                                        <input type="checkbox" id="chk_activo" name="chk_activo" value="1" checked>Activo.
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


function _InterfazTipoPagoPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazTipoPago();
    $html = $objIn->interfazPrincipal();

    $rpta->addScript('
        $(document).ready(function(){
            $(".table").DataTable();
        });'
    );

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    $rpta->addScript("
        $('#btnNuevo').unbind('click').click(function(){
            xajax__InterfazTipoPagoFormulario();
        });
    ");

    return $rpta;
}

function _InterfazTipoPagoListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazTipoPago();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazTipoPagoFormulario($tipopago = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazTipoPago();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formulariotipopago($tipopago));
    
    $obj = new MenTipoP();
    $response = $obj->consultar(2, $tipopago);
    $resultado = json_decode($response, true);


    if ($response !== "MSG_0006"){
    
        if ($tipopago == ""){

            $rpta->addAssign("formTitle01",'innerHTML',"Nuevo Tipo Pago");
            $rpta->addAssign("btnGrabar",'innerHTML',"Guardar");

        }else{

            $rpta->addAssign("formTitle01",'innerHTML',"Editar Tipo Pago");
            $rpta->addAssign("btnGrabar",'innerHTML',"Actualizar");

       
            $rpta->addAssign("txt_descripcion","value",$resultado["descripcion"]);

            if ($resultado["activo"] == 1) {
                
                $rpta->addScript("
                    $('#chk_activo').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#chk_activo').prop('checked',false);
                ");
            }

            if ($resultado["requiereEfectivo"] == 1) {
                
                $rpta->addScript("
                    $('#rbtn_efectivo').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#rbtn_efectivo').prop('checked',false);
                ");
            }

            if ($resultado["requiereNumOperacion"] == 1) {
                
                $rpta->addScript("
                    $('#rbtn_numoperacion').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#rbtn_numoperacion').prop('checked',false);
                ");
            }
        }

        $rpta->addScript("
            obtenerRadioVal();

            $('#btnGrabar').unbind('click').click(function(){
                validaERP.valida({
                    form: '#formtipopago',
                    items: {
                        txt_descripcion: {
                            required: true
                        }
                    },
                    success: function() {
                        var xFlag = $('#btnGrabar').html() == 'Guardar' ? '1' : '2';
                        xajax__InterfazTipoPagoMantenimiento(xFlag, xajax.getFormValues('formtipopago', true));
                    }
                });
            });

            $('#modal-default').modal('show');
            $('#txt_descripcion').focus();
        ");

    }else{
        $rpta->addAlert("Tipo Operacion no existe");
    }

    return $rpta;
}

function _InterfazTipoPagoMantenimiento($xFlag, $xForm){

    $rpta = new xajaxResponse();

    $objR = new MenTipoP();
    $resul = $objR->mantenimientoData($xFlag, $xForm);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            xajax__InterfazTipoPagoListado();
                $('#modal-default').modal('hide');
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazTipoPagoPrincipal");
$xajax->registerFunction("_InterfazTipoPagoListado");
$xajax->registerFunction("_InterfazTipoPagoFormulario");
$xajax->registerFunction("_InterfazTipoPagoMantenimiento");

?>
