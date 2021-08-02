<?php 

//require_once(APP_DIR_CLASS . 'configuracion/men_area.class.php');

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
                                                <select class="form-control" id="lst_tipoproducto" name="lst_tipoproducto" onchange="" style="margin-left: 10px;">';

                                                $obj = new MenArea();
                                                $response = $obj->consultar(1);
                                                $datos = json_decode($response, true);

                                                foreach($datos as $key => $value){

                                                    $html .='<option value="'.$value['area'].'">'.$value['descripcion'].'</option>';
                                                }
                                                    
                                $html .=        '</select>
                                            </span>
                                        </div>

                                    </div>
                                
                                    <div class="box-body">                                       

                                        <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                                            <div class="table-responsive">

                                                <table class="table table-striped table-bordered table-condensed table-hover">

                                                    <thead>
                                                        <tr>
                                                            <th style="width: 1%; text-align: center">Codigo</th>
                                                            <th style="width: 180px; text-align: center">Descripcion</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="td_listado">
                                                    
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

        $obj = new MenProducto();
        $response = $obj->consultar(1);
        $datos = json_decode($response, true);

        if ($response == "1"){  
            $html = showEror($obj->getMsgErr()); 
        }else{
      
            foreach ($datos as $key => $value) {
                
                $html .= '

                <tr>

                    <td style="text-align: center">'.$value['producto'].'</td>
                    <td style="text-align: ">'.$value['descripcion'].'</td>
                </tr>';
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



$xajax->registerFunction("_InterfazGrupoDespachoPrincipal");
$xajax->registerFunction("_listarProductos");
//$xajax->registerFunction("_interfazGrupoDespachoFormulario");
//$xajax->registerFunction("_interfazGrupoDespachoMantenimiento");

?>
