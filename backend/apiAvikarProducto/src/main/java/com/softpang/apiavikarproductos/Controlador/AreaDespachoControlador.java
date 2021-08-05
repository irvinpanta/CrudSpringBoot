package com.softpang.apiavikarproductos.Controlador;

import com.softpang.apiavikarproductos.Entity.AreaDespachoEntity;
import com.softpang.apiavikarproductos.Servicio.AreaDespachoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.jpa.repository.Query;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Optional;

@RestController
@RequestMapping("/api/areadespacho")
@CrossOrigin
public class AreaDespachoControlador {

    @Autowired
    private AreaDespachoServicio areaDespachoSer;

    private String message = "";
    private HttpStatus status;

    @GetMapping("/listar/query")
    public ResponseEntity<ArrayList<AreaDespachoEntity>> listarByArea(@RequestParam("area") Integer id){

        if(!areaDespachoSer.existsByArea(id)){
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        }else{
            ArrayList<AreaDespachoEntity> lista = areaDespachoSer.listarByArea(id);
            return new ResponseEntity(lista, HttpStatus.OK);

        }
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody AreaDespachoEntity despacho){

        if(areaDespachoSer.existsByProducto(despacho.getProducto().getProducto())){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else if(despacho.getArea().getArea() == 0){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        } else {
            areaDespachoSer.mantenimientoData(despacho);
            message = "MSG_0001"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") Integer id){

        try {
            if(!areaDespachoSer.existsByIdDespacho(id)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;
            }else{
                areaDespachoSer.delete(id);
                message = "MSG_0003"; status = HttpStatus.OK;
            }

            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity(ex, HttpStatus.CONFLICT);
        }

    }


}
