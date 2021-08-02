<?php 

require_once(APP_DIR_CLASS . 'configuracion/men_mesas.class.php');

class InterfazMesas
{
    
    function interfazPrincipal(){

        $titulo = 'Configuración de Mesas';

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
                                                <th style="width: 10px; text-align: center">Cantidad</th>
                                                <th style="width: 30px; text-align: center">Salon</th>
                                                <th style="width: 5px; text-align: center">Mesa Rapida</th>
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

        $obj = new MenMesas();
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

                if ($value['mesarapida'] == '1'){
                    $estadoM = "Si";
                    $colorM = "label label-success";
                }else{
                    $estadoM = "No";
                    $colorM = "label label-warning";
                }

                
                $html .= '

                <tr>
                    

                    <td style="text-align: center">
                        <a title = "'.MSG_0010.'" href = javascript:void(0) 
                        onclick="
                            xajax__InterfazMesasFormulario(\''.$value['mesa'].'\');
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
                                      xajax__InterfazMesasMantenimiento(\'3\',\''.$value['mesa'].'\')
                                  }
                            })

                      ">
                      <i class="color-icons icons_delete"></i>
                      </a>
                    </td>
                    <td style="text-align: center">' . (++$contador) . '</td> 
                    <!--<td style="text-align: center">'.$value['mesa'].'</td>-->
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                    <td style="text-align: center">'.$value['cantidad'].'</td>
                    <td style="text-align: ">'.$value['salon']['descripcion'].'</td>
                    <td style="text-align: center"><span class="'.$colorM.'">'.$estadoM.'</span></td>
                    <td style="text-align: center"><span class="'.$color.'">'.$estado.'</span></td>
                </tr>';
            }

        }
        return $html;
    }

    function formulariomesa($mesa=''){



        $html = '

        <div class="modal" id="modal-default" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 id="formTitle01">Configuración de mesa</h4>
                    </div>  

                    <div class="modal-body">
                        <form id="formmesa" name="formmesa" onSubmit="return false" onkeypress="if(gKeyEnter(event)) return false;">

                            <div class="well-login">
        
                                <input type="hidden" id="id" name="id" value="'.$mesa.'">

                                <div class="form-group" style="margin-left: 12px;">
                                    <label>Descripcion:</label>
                                    <input type="text" id="txt_descripcion" name="txt_descripcion" class="form-control" placeholder="Descripcion"/>
                                </div>

                                <div class="form-group">

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group">
                                            <label>Cantidad:</label>
                                            <input type="text" id="txt_cantidad" name="txt_cantidad" class="form-control" placeholder="Cantidad de Personas" />
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-8">
                                    <div class="form-group">
                                      <label>Salon:</label>
                                      <select class="form-control" id="lst_salon" name="lst_salon" onchange="">';

                            $obj = new MenSalon();
                            $response = $obj->consultarSalon(1);
                            $datos = json_decode($response, true);

                            foreach($datos as $key => $value){

                                $html .='<option value="'.$value['salon'].'">'.$value['descripcion'].'</option>';
                            }
                                                

                            $html .=      '</select>
                                        </div>
                                    </div>


                                </div>


                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 40px;">
                                        <input type="checkbox" id="chk_activo" name="chk_activo" value="1" checked /> Activo.
                                    </label>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox" style="margin-left: 40px;">
                                        <input type="checkbox" id="chk_mesarapida" name="chk_mesarapida" value="0"/> Mesa rapida.
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


function _InterfazMesasPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazMesas();
    $html = $objIn->interfazPrincipal();

    $rpta->addScript('
        $(document).ready(function(){
            $(".table").DataTable();
        });'
    );

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    $rpta->addScript("
        $('#btnNuevo').unbind('click').click(function(){
            xajax__InterfazMesasFormulario();
        });
    ");

    return $rpta;
}

function _InterfazMesasListado() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazMesas();
    $rptaHtml = $objIn->interfazListado();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _InterfazMesasFormulario($mesa = ''){

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new InterfazMesas();
    $rpta->addAssign("ajaxFormulario", "innerHTML", $objIn->formulariomesa($mesa));
    
    $obj = new MenMesas();
    $response = $obj->consultar(2, $mesa);
    $resultado = json_decode($response, true);


    if ($response !== "MSG_0006"){
    
        if ($mesa == ""){

            $rpta->addAssign("formTitle01",'innerHTML',"Nuevo mesa");
            $rpta->addAssign("btnGrabar",'innerHTML',"Guardar");

        }else{

            $rpta->addAssign("formTitle01",'innerHTML',"Editar mesa");
            $rpta->addAssign("btnGrabar",'innerHTML',"Actualizar");

       
            $rpta->addAssign("txt_descripcion","value",$resultado["descripcion"]);
            $rpta->addAssign("txt_cantidad","value",$resultado["cantidad"]);

            $rpta->addAssign("lst_salon","value",$resultado['salon']["salon"]);

            if ($resultado["activo"] == 1) {
                
                $rpta->addScript("
                    $('#chk_activo').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#chk_activo').prop('checked',false);
                ");
            }

            if ($resultado["mesarapida"] == 1) {
                
                $rpta->addScript("
                    $('#chk_mesarapida').prop('checked',true);
                ");

            }else{

                $rpta->addScript("
                    $('#chk_mesarapida').prop('checked',false);
                ");
            }

        }

        $rpta->addScript("
        
            $('#btnGrabar').unbind('click').click(function(){
                validaERP.valida({
                    form: '#formmesa',
                    items: {
                        txt_descripcion: {
                            required: true
                        },
                        lst_salon:{
                            required: true
                        },
                        txt_cantidad: {
                            required: true,
                            number: true
                        }
                    },
                    success: function() {
                        var xFlag = $('#btnGrabar').html() == 'Guardar' ? '1' : '2';
                        xajax__InterfazMesasMantenimiento(xFlag, xajax.getFormValues('formmesa', true));
                    }
                });
            });

            $('#modal-default').modal('show');
            $('#txt_descripcion').focus();
        ");

    }else{
        $rpta->addAlert("mesa no existe");
    }

    return $rpta;
}

function _InterfazMesasMantenimiento($xFlag, $xForm){

    $rpta = new xajaxResponse();

    $objR = new MenMesas();
    $resul = $objR->mantenimientoData($xFlag, $xForm);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            xajax__InterfazMesasListado();
                $('#modal-default').modal('hide');
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazMesasPrincipal");
$xajax->registerFunction("_InterfazMesasListado");
$xajax->registerFunction("_InterfazMesasFormulario");
$xajax->registerFunction("_InterfazMesasMantenimiento");

?>
