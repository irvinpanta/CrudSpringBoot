package com.softpang.apiavikarproductos.Controlador;


import com.softpang.apiavikarproductos.Entity.TipoProductoEntity;
import com.softpang.apiavikarproductos.Modelo.TipoProductoModelDto;
import com.softpang.apiavikarproductos.Servicio.TipoProductoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Optional;

@RestController
@RequestMapping("/api/tipoproducto")
@CrossOrigin(origins = "http://localhost:8081")
public class TipoProductoControlador {

    @Autowired
    private TipoProductoServicio tipoProductoServicio;

    private String message = "";
    private HttpStatus status;

    @GetMapping("/listar")
    public ResponseEntity<TipoProductoEntity> listarAll(){
        ArrayList<TipoProductoEntity> lista = tipoProductoServicio.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<TipoProductoEntity> buscarPorId(@PathVariable("id") Integer id){

        if (!tipoProductoServicio.existsById(id)){
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        }else{
            TipoProductoEntity tipoProductoEntity = tipoProductoServicio.buscarPorId(id).get();
            return new ResponseEntity(tipoProductoEntity, HttpStatus.OK);

        }
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody TipoProductoModelDto tipoProDto){

        if(tipoProductoServicio.existsByDescripcion(tipoProDto.getDescripcion())){
            message = "MSG_0005"; status = HttpStatus.NOT_FOUND;

        }else if (tipoProDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else{
            TipoProductoEntity entity = new TipoProductoEntity(
                                                        tipoProDto.getDescripcion(),
                                                        tipoProDto.getActivo());
            tipoProductoServicio.mantenimientoData(entity);
            message = "MSG_0001"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") Integer id, @RequestBody TipoProductoModelDto tipoProDto){

        if(!tipoProductoServicio.existsById(id)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else if(tipoProDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if (tipoProductoServicio.existsByDescripcion(tipoProDto.getDescripcion()) && tipoProductoServicio.buscarPorDescripcion(tipoProDto.getDescripcion()).get().getTipoProducto() != id){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else{

            TipoProductoEntity entity = tipoProductoServicio.buscarPorId(id).get();
            entity.setDescripcion(tipoProDto.getDescripcion());
            entity.setActivo(tipoProDto.getActivo());
            tipoProductoServicio.mantenimientoData(entity);

            message = "MSG_0002"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") Integer id){

        try {
            if (!tipoProductoServicio.existsById(id)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

            }else{
                tipoProductoServicio.delete(id);
                message = "MSG_0003"; status = HttpStatus.OK;
            }
            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }

}
