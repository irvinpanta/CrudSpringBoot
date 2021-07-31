<?php 

require_once(APP_DIR_CLASS . 'configuracion/men_producto.class.php');

class InterfazProducto
{
    
    function interfazPrincipal(){

        $titulo = 'Configuración de producto';

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
                                                <!--<th style="width: 1%; text-align: center">Codigo</th>-->
                                                <th style="width: 180px; text-align: center">Descripcion</th>
                                                <th style="width: 30px; text-align: center">Tipo Producto</th>
                                                <th style="width: 30px; text-align: center">Fam. Producto</th>
                                                <th style="width: 5px; text-align: center">Stock</th>
                                                <th style="width: 5px; text-align: center">Precio</th>
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

        $obj = new MenProducto();
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
                    

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazProductoFormulario(\''.$value['producto'].'\');
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
                                      xajax__InterfazProductoMantenimiento(\'3\',\''.$value['producto'].'\')
                                  }
                            })

                      ">
                      <i class="color-icons icons_delete"></i>
                      </a>
                    </td>
                    <td style="text-align: center">' . (++$contador) . '</td> 
                    <!--<td style="text-align: center">'.$value['producto'].'</td>-->
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                    <td style="text-align: ">'.$value['tipoProducto']['descripcion'].'</td>
                    <td style="text-align: ">'.$value['famproducto']['descripcion'].'</td>
                    <td style="text-align: center">'.$value['stock'].'</td>
                    <td style="text-align: center">'.$value['precio'].'</td>
                    <td style="text-align: center"><span class="'.$color.'">'.$estado.'</span></td>
                </tr>';
            }

        }
        return $html;
    }

    function formularioproducto($producto=''){



        $html = '

        <div class="modal" id="modal-default" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Configuración de producto</h4>
                    </div>  

                    <div class="modal-body">
                        <form id="formproducto" name="formproducto" onSubmit="return false" onkeypress="if(gKeyEnter(event)) return false;">

                            <div class="well-login">
        
                                <input type="hidden" id="id" name="id" value="'.$producto.'">

                                <div class="form-group" style="margin-left: 12px;">
                                    <label>Descripcion:</label>
                                    <input type="text" id="txt_descripcion" name="txt_descripcion" class="form-control" placeholder="Descripcion"/>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Stock:</label>
                                            <input type="text" id="txt_stock" name="txt_stock" class="form-control" placeholder="Stock" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Precio:</label>
                                            <input type="text" id="txt_precio" name="txt_precio" class="form-control" placeholder="Precio" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                      <label>Tipo de Producto:</label>
                                      <select class="form-control" id="lst_tipoproducto" name="lst_tipoproducto" onchange="">';

                        $obj = new MenTipoProducto();
                        $response = $obj->consultar(1);
                        $datos = json_decode($response, true);

                        foreach($datos as $key => $value){

                            $html .='<option value="'.$value['tipoProducto'].'">'.$value['descripcion'].'</option>';
                        }
                                            

                        $html .=      '</select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                      <label>Fam. Producto:</label>
                                      <select class="form-control" id="lst_famproducto" name="lst_famproducto" onchange="">';
                        
                        $obj = new MenFamPro();
                        $response = $obj->consultar(1);
                        $datos = json_decode($response, true);

                        foreach($datos as $key => $value){

                            $html .='<option value="'.$value['id'].'">'.$value['descripcion'].'</option>';
                        }

                        $html .=      '</select>
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 40px;">
                                        <input type="checkbox" id="chk_activo" name="chk_activo" value="1" checked /> Activo.
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


function _InterfazProductoPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazProducto();
    $html = $objIn->interfazPrincipal();

    $rpta->addScript('
        $(document).ready(function(){
            $(".table").DataTable();
        });'
    );

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    $rpta->addScript("
        $('#btnNuevo').unbind('click').click(function(){
            xajax__InterfazProductoFormulario();
        });
    ");

    return $rpta;
}

function _InterfazProductoListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazProducto();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazProductoFormulario($producto = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazProducto();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formularioproducto($producto));
    
    $obj = new MenProducto();
    $response = $obj->consultar(2, $producto);
    $resultado = json_decode($response, true);


    if ($response !== "MSG_0006"){
    
        if ($producto == ""){

            $rpta->addAssign("formTitle01",'innerHTML',"Nuevo producto");
            $rpta->addAssign("btnGrabar",'innerHTML',"Guardar");

        }else{

            $rpta->addAssign("formTitle01",'innerHTML',"Editar producto");
            $rpta->addAssign("btnGrabar",'innerHTML',"Actualizar");

       
            $rpta->addAssign("txt_descripcion","value",$resultado["descripcion"]);
            $rpta->addAssign("txt_stock","value",$resultado["stock"]);
            $rpta->addAssign("txt_precio","value",$resultado["precio"]);

            $rpta->addAssign("lst_tipoproducto","value",$resultado['tipoProducto']["tipoProducto"]);
            $rpta->addAssign("lst_famproducto","value",$resultado['famproducto']["id"]);

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
                    form: '#formproducto',
                    items: {
                        txt_descripcion: {
                            required: true
                        }
                    },
                    success: function() {
                        var xFlag = $('#btnGrabar').html() == 'Guardar' ? '1' : '2';
                        xajax__InterfazProductoMantenimiento(xFlag, xajax.getFormValues('formproducto', true));
                    }
                });
            });

            $('#modal-default').modal('show');
            $('#txt_descripcion').focus();
        ");

    }else{
        $rpta->addAlert("producto no existe");
    }

    return $rpta;
}

function _InterfazProductoMantenimiento($xFlag, $xForm){

    $rpta = new xajaxResponse();

    $objR = new MenProducto();
    $resul = $objR->mantenimientoData($xFlag, $xForm);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            xajax__InterfazProductoListado();
                $('#modal-default').modal('hide');
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazProductoPrincipal");
$xajax->registerFunction("_InterfazProductoListado");
$xajax->registerFunction("_InterfazProductoFormulario");
$xajax->registerFunction("_InterfazProductoMantenimiento");

?>
