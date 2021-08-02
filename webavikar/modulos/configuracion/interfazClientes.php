<?php 

require_once(APP_DIR_CLASS . 'configuracion/men_cliente.class.php');

class InterfazClientes
{
    
    function interfazPrincipal(){

        $titulo = 'Configuración de Clientes';

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
                                                
                                                <th style="width: 1%; text-align: center" colspan=""></th>
                                                <th style="width: 1%; text-align: center" colspan=""></th>
                                                <th style="width: 1%; text-align: center">Nro.</th>
                                                <th style="width: 20px; text-align: center">Doc. Identidad</th>
                                                <th style="width: 100px; text-align: center">Cliente</th>
                                                <th style="width: 80px; text-align: center">Direccion</th>
                                                <th style="width: 20px; text-align: center">Telefono</th>
                                                <th style="width: 30px; text-align: center">Defecto</th>
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

        $obj = new MenCliente();
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

                if ($value['defecto'] == '1'){
                    $estadoD = "Si";
                    $colorD = "label label-success";
                }else{
                    $estadoD = "No";
                    $colorD = "label label-warning";
                }

                
                $html .= '

                <tr>
                    

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazClientesFormulario(\''.$value['persona'].'\');
                        "><i class="color-icons icons_editar"></i>
                        </a>                       
                    </td>

                    <td style="text-align: center;">
                        <a title = "'.MSG_0011.'" href = javascript:void(0) 
                        onclick="

                            Swal.fire({
                              allowOutsideClick: false,
                              title: \''.MSG_0020.'\',
                              text: \''.$value['numerodocumento'].'\',
                              icon: \'question\',
                              showCancelButton: true,
                              confirmButtonColor: \'#3085d6\',
                              cancelButtonColor: \'#d33\',
                              confirmButtonText: \'Si, Eliminar registro!\'
                              }).then((result) => {
                                  if (result.isConfirmed) {
                                      xajax__InterfazClientesMantenimiento(\'3\',\''.$value['persona'].'\')
                                  }
                            })

                      ">
                      <i class="color-icons icons_delete"></i>
                      </a>
                    </td>
                    <td style="text-align: center">' . (++$contador) . '</td> 
                    <td style="text-align: center">'.$value['numerodocumento'].'</td>
                    <td style="text-align: ">'.$value['nombres'].' '.$value['apellidos'].'</td>
                    <td style="text-align: ">'.$value['direccion'].'</td>
                    <td style="text-align: center">'.$value['telefono'].'</td>
                    <td style="text-align: center"><span class="'.$colorD.'">'.$estadoD.'</span></td>
                    <td style="text-align: center"><span class="'.$color.'">'.$estado.'</span></td>
                </tr>';
            }

        }
        return $html;
    }

    function formulariopersona($persona=''){



        $html = '

        <div class="modal" id="modal-default" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Configuración de Clientes</h4>
                    </div>  

                    <div class="modal-body">
                        <form id="formpersona" name="formpersona" onSubmit="return false" onkeypress="if(gKeyEnter(event)) return false;">

                            <div class="well-login">
        
                                <input type="hidden" id="id" name="id" value="'.$persona.'">

                            
                                <div class="form-group" style="margin-left: 12px;">
                                    <label>Nombres:</label>
                                    <input type="text" id="txt_nombres" name="txt_nombres" class="form-control" placeholder="Ingrese Nombres"/>
                                </div>

                                <div class="form-group" style="margin-left: 12px;">
                                    <label>Apellidos:</label>
                                    <input type="text" id="txt_apellidos" name="txt_apellidos" class="form-control" placeholder="Ingrese Apellidos"/>
                                </div>

                                <div class="form-group" style="margin-left: 12px;">
                                    <label>Direccion:</label>
                                    <input type="text" id="txt_direccion" name="txt_direccion" class="form-control" placeholder="Ingrese direccion"/>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Doc. Identidad:</label>
                                    <input type="text" id="txt_dni" name="txt_dni" class="form-control" placeholder="Ingrese Doc. de Identidad"/>
                                </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label>Telefono:</label>
                                    <input type="text" id="txt_telefono" name="txt_telefono" class="form-control" placeholder="Ingrese Telefono"/>
                                </div>
                                </div>

                                <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 40px;">
                                        <input type="checkbox" id="chk_activo" name="chk_activo" value="1" checked /> Activo.
                                    </label>
                                </div>
                                </div>

                                <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 40px;">
                                        <input type="checkbox" id="chk_defecto" name="chk_defecto" value="0" /> Defecto.
                                    </label>
                                </div>
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


function _InterfazClientesPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazClientes();
    $html = $objIn->interfazPrincipal();

    $rpta->addScript('
        $(document).ready(function(){
            $(".table").DataTable();
        });'
    );

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    $rpta->addScript("
        $('#btnNuevo').unbind('click').click(function(){
            xajax__InterfazClientesFormulario();
        });
    ");

    return $rpta;
}

function _InterfazClientesListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazClientes();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazClientesFormulario($persona = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazClientes();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formulariopersona($persona));
    
    $obj = new MenCliente();
    $response = $obj->consultar(2, $persona);
    $resultado = json_decode($response, true);


    if ($response !== "MSG_0006"){
    
        if ($persona == ""){

            $rpta->addAssign("formTitle01",'innerHTML',"Nuevo persona");
            $rpta->addAssign("btnGrabar",'innerHTML',"Guardar");

        }else{

            $rpta->addAssign("formTitle01",'innerHTML',"Editar persona");
            $rpta->addAssign("btnGrabar",'innerHTML',"Actualizar");

       
            $rpta->addAssign("txt_dni","value",$resultado["numerodocumento"]);
            $rpta->addAssign("txt_nombres","value",$resultado["nombres"]);
            $rpta->addAssign("txt_apellidos","value",$resultado["apellidos"]);
            $rpta->addAssign("txt_direccion","value",$resultado["direccion"]);
            $rpta->addAssign("txt_telefono","value",$resultado["telefono"]);


            if ($resultado["activo"] == 1) {
                
                $rpta->addScript("
                    $('#chk_activo').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#chk_activo').prop('checked',false);
                ");
            }

            if ($resultado["defecto"] == 1) {
                
                $rpta->addScript("
                    $('#chk_defecto').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#chk_defecto').prop('checked',false);
                ");
            }

        }

        $rpta->addScript("
        
            $('#btnGrabar').unbind('click').click(function(){
                validaERP.valida({
                    form: '#formpersona',
                    items: {
                        txt_dni: {
                            required: true,
                            minlength: 8,
                            maxlength: 11,
                            number: true
                        },
                        txt_nombres: {
                            required: true,
                            minlength: 3
                        },
                        txt_apellidos: {
                            required: true
                        },
                        txt_direccion: {
                            required: true
                        },
                        txt_telefono: {
                            number: true
                        }
                    },
                    success: function() {
                        var xFlag = $('#btnGrabar').html() == 'Guardar' ? '1' : '2';
                        xajax__InterfazClientesMantenimiento(xFlag, xajax.getFormValues('formpersona', true));
                    }
                });
            });

            $('#modal-default').modal('show');
            $('#txt_descripcion').focus();
        ");

    }else{
        $rpta->addAlert("persona no existe");
    }

    return $rpta;
}

function _InterfazClientesMantenimiento($xFlag, $xForm){

    $rpta = new xajaxResponse();

    $objR = new MenCliente();
    $resul = $objR->mantenimientoData($xFlag, $xForm);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            xajax__InterfazClientesListado();
                $('#modal-default').modal('hide');
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazClientesPrincipal");
$xajax->registerFunction("_InterfazClientesListado");
$xajax->registerFunction("_InterfazClientesFormulario");
$xajax->registerFunction("_InterfazClientesMantenimiento");

?>
