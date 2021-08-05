<?php 

require_once(APP_DIR_CLASS . 'productos/men_grupodespacho.class.php');

class interfazGrupoDespacho
{
    
    function interfazPrincipal(){

        $titulo = 'Grupo despacho';

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

                        <section class="row">
                            <div class="col-md-12 ">
                                <div class="box">
                                    <div class="box-header with-border">

                                        <h3 class="box-title" style="font-size: 14px;">Productos</h3>

                                        <div class="box-tools pull-right">
                                            <span class="label label-danger">8 New Members</span>
                                        </div>
                                    </div>
                                
                                    <div class="box-body">
                                        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                                            <div class="table-responsive">

                                                <table class="table table-striped table-bordered table-condensed table-hover">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 1%; text-align: center">Nro.</th>
                                                            <th style="width: 1%; text-align: center" colspan=""></th>
                                                            <th style="width: 1%; text-align: center">Codigo</th>
                                                            <th style="width: 180px; text-align: center">Descripcion</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="td_listado">
                                                    '.$this->interfazListadoProductos().'
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-header with-border">

                                        <h4 class="box-title" style="font-size: 14px;">Grupo: </h4>

                                        <div class="box-tools pull-right">
                                            <span class="label label-warning">
                                                <label> Tipo de Producto: </label>
                                            </span>
                                            <span>
                                                <select class="form-control" id="lst_area" name="lst_area" onchange="xajax__interfazListGrupo(this.value);" style="margin-left: 10px;">
                                                    <option value="0">Seleccionar...</option>';

                                                $obj = new MenArea();
                                                $response = $obj->consultar(1);
                                                $datos = json_decode($response, true);

                                                if($response != "1"){


                                                    foreach($datos as $key => $value){

                                                        $html .='<option value="'.$value['area'].'">'.$value['descripcion'].'</option>';
                                                    }
                                                }
                                                    
                                $html .=        '</select>
                                            </span>
                                        </div>

                                    </div>
                                
                                    <div class="box-body">                                       

                                        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                                            <div class="table-responsive">

                                                <table class="table1 table-striped table-bordered table-condensed table-hover">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 1%; text-align: center">Nro.</th>
                                                            <th style="width: 1%; text-align: center" colspan=""></th>
                                                            <th style="width: 1%; text-align: center">Codigo</th>
                                                            <th style="width: 180px; text-align: center">Descripcion</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="td_listadoGrupo">
                                                    
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>

                    </div>
                </div>';

        return $html;
    }

    function interfazListadoProductos(){

        $html = '';
        $contador = 0;

        $obj = new MenProducto();
        $response = $obj->consultar(1);
        $datos = json_decode($response, true);

        if ($response == "1"){  
            $html = showEror($obj->getMsgErr()); 
        }else{
      
            foreach ($datos as $key => $value) {
                
                $html .= '

                <tr>
                    <td style="text-align: center">' . (++$contador) . '</td> 
                        <td style="text-align: center">
                        <a title = "Quitar" href = javascript:void(0) 
                            onclick="
                                xajax__interfazGrupoMantenimiento(\'1\',\''.$value['producto'].'\', $(\'#lst_area\').val())

                                "><i class="color-icons icons_add"></i>
                        </a>                       
                    </td>
                    <td style="text-align: center">'.$value['producto'].'</td>
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                </tr>';
            }

        }
        return $html;
    }

    function interfazListadoGrupo($area){

        $html = '';
        $contador=0;

        $obj = new MenGrupoDespacho();
        $response = $obj->consultar(2, $area);
        $datos = json_decode($response, true);

        if ($response == "1"){  
            $html = showEror($obj->getMsgErr()); 
        }else{

            if($response != "MSG_0006"){
                
                foreach ($datos as $key => $value) {
                
                    $html .= '

                    <tr>
                        <td style="text-align: center">' . (++$contador) . '</td> 
                        <td style="text-align: center">
                        <a title = "Quitar" href = javascript:void(0) 
                            onclick="
                                xajax__interfazGrupoMantenimiento(\'3\', \'\', \'\', \''.$value['despacho'].'\')
                                "><i class="color-icons icons_delete"></i>
                            </a>                       
                        </td>
                        <td style="text-align: center">'.$value['producto']['producto'].'</td>
                        <td style="text-align: ">'.$value['producto']['descripcion'].'</td>
                    </tr>';
                }
            }else{
                $html = '<td colspan="4">'.showEror("Upps, Al parecer no se econtraron registros..."). '</td>'; 
            }
      
            

        }
        return $html;
    }


}


function _interfazGrupoDespachoPrincipal() {

    $rpta = new xajaxResponse('UTF-8');

    $objIn = new interfazGrupoDespacho();
    $html = $objIn->interfazPrincipal();

    $rpta->addScript('
        $(document).ready(function(){
            $(".table").DataTable();
        });'
    );

    $rpta->addAssign("container-fluid", "innerHTML", $html);
    return $rpta;
}

function _listarProductos() {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new interfazGrupoDespacho();
    $rptaHtml = $objIn->interfazListadoProductos();

    $rpta->addAssign("td_listado", "innerHTML", $rptaHtml);
    
    return $rpta;
}

function _interfazListGrupo($area) {
    
    $rpta = new xajaxResponse('UTF-8');

    $objIn = new interfazGrupoDespacho();
    $rptaHtml = $objIn->interfazListadoGrupo($area);

    $rpta->addAssign("td_listadoGrupo", "innerHTML", $rptaHtml);
    
    return $rpta;
}


function _interfazGrupoMantenimiento($xFlag, $xIdProducto = '', $xIdArea = '', $xIdDespacho = ''){

    $rpta = new xajaxResponse();

    $objR = new MenGrupoDespacho();
    $resul = $objR->mantenimientoData($xFlag, $xIdProducto, $xIdArea, $xIdDespacho);

    if($resul == "0"){
        $rpta->addAlert($objR->getMsgErr());
    }else{

        $rpta->addAlert(constant($resul));
        $rpta->addScript("
            var id = $('#lst_area').val();
            xajax__interfazListGrupo(id);
            
       ");

    }
    
    return $rpta;
}


$xajax->registerFunction("_InterfazGrupoDespachoPrincipal");
$xajax->registerFunction("_listarProductos");
$xajax->registerFunction("_interfazListGrupo");
$xajax->registerFunction("_interfazGrupoMantenimiento");

?>
