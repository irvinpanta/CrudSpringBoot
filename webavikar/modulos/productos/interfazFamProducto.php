<?php 

require_once(APP_DIR_CLASS . 'productos/men_famproducto.class.php');

class InterfazFamProducto
{
    
    function interfazPrincipal(){

        $titulo = 'Configuración de Fam. Producto';

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

        $obj = new MenFamPro();
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

                
                $html .= '

                <tr>
                    <td style="text-align: center">' . (++$contador) . '</td> 

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazFamProductoFormulario(\''.$value['id'].'\');
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
                                      xajax__InterfazFamProductoMantenimiento(\'3\',\''.$value['id'].'\')
                                  }
                            })

                      ">
                      <i class="color-icons icons_delete"></i>
                      </a>
                    </td>
                    <td style="text-align: center">'.$value['id'].'</td>
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                    <td style="text-align: center"><span class="'.$color.'">'.$estado.'</span></td>
                </tr>';
            }

        }
        return $html;
    }

    function formularioid($id=''){

        $html = '

        <div class="modal" id="modal-default" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Configuración de Fam. Producto</h4>
                    </div>  

                    <div class="modal-body">
                        <form id="formid" name="formid" onSubmit="return false" onkeypress="if(gKeyEnter(event)) return false;">

                            <div class="well-login">
        
                                <input type="hidden" id="id" name="id" value="'.$id.'">

                                <div class="form-group">
                                    <label>Descripcion:</label>
                                    <input type="text" id="txt_descripcion" name="txt_descripcion" class="form-control" placeholder="Descripcion">
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


function _InterfazFamProductoPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazFamProducto();
    $html = $objIn->interfazPrincipal();

    $rpta->addScript('
        $(document).ready(function(){
            $(".table").DataTable();
        });'
    );

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    $rpta->addScript("
        $('#btnNuevo').unbind('click').click(function(){
            xajax__InterfazFamProductoFormulario();
        });
    ");

    return $rpta;
}

function _InterfazFamProductoListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazFamProducto();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazFamProductoFormulario($id = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazFamProducto();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formularioid($id));
    
    $obj = new MenFamPro();
    $response = $obj->consultar(2, $id);
    $resultado = json_decode($response, true);


    if ($response !== "MSG_0006"){
    
        if ($id == ""){

            $rpta->addAssign("formTitle01",'innerHTML',"Nuevo Fam. Producto");
            $rpta->addAssign("btnGrabar",'innerHTML',"Guardar");

        }else{

            $rpta->addAssign("formTitle01",'innerHTML',"Editar Fam. Producto");
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

        }

        $rpta->addScript("
        
            $('#btnGrabar').unbind('click').click(function(){
                validaERP.valida({
                    form: '#formid',
                    items: {
                        txt_descripcion: {
                            required: true
                        }
                    },
                    success: function() {
                        var xFlag = $('#btnGrabar').html() == 'Guardar' ? '1' : '2';
                        xajax__InterfazFamProductoMantenimiento(xFlag, xajax.getFormValues('formid', true));
                    }
                });
            });

            $('#modal-default').modal('show');
            $('#txt_descripcion').focus();
        ");

    }else{
        $rpta->addAlert("id no existe");
    }

    return $rpta;
}

function _InterfazFamProductoMantenimiento($xFlag, $xForm){

    $rpta = new xajaxResponse();

    $objR = new MenFamPro();
    $resul = $objR->mantenimientoData($xFlag, $xForm);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            xajax__InterfazFamProductoListado();
                $('#modal-default').modal('hide');
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazFamProductoPrincipal");
$xajax->registerFunction("_InterfazFamProductoListado");
$xajax->registerFunction("_InterfazFamProductoFormulario");
$xajax->registerFunction("_InterfazFamProductoMantenimiento");

?>
