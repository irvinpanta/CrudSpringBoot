package com.softpang.apiavikarproductos.Controlador;

import com.softpang.apiavikarproductos.Entity.FamProductoEntity;
import com.softpang.apiavikarproductos.Modelo.FamProductoModelDto;
import com.softpang.apiavikarproductos.Servicio.FamProductoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/famproducto")
@CrossOrigin(origins = "http://localhost:8081")
public class FamProductoControlador {

    @Autowired
    private FamProductoServicio famProductoSer;

    private String message = "";
    private HttpStatus status;

    @GetMapping("/listar")
    public ResponseEntity<FamProductoEntity> listarAll(){
        ArrayList<FamProductoEntity> lista = famProductoSer.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<FamProductoEntity> buscarPorId(@PathVariable("id") Integer id){
        if(!famProductoSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        FamProductoEntity resul = famProductoSer.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody FamProductoModelDto famProDto){

        if(famProductoSer.existsByDescripcion(famProDto.getDescripcion())){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else if(famProDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;
        }else{
            FamProductoEntity entity = new
                    FamProductoEntity(famProDto.getDescripcion(), famProDto.getActivo());

            famProductoSer.mantenimientoData(entity);
            message = "MSG_0001"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") Integer id, @RequestBody FamProductoModelDto famProDto){

        if(!famProductoSer.existsById(id)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else if(famProDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if(famProductoSer.existsByDescripcion(famProDto.getDescripcion()) && famProductoSer.buscarPorDescripcion(famProDto.getDescripcion()).get().getId() != id){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else{
            FamProductoEntity entity = famProductoSer.buscarPorId(id).get();
            entity.setDescripcion(famProDto.getDescripcion());
            entity.setActivo(famProDto.getActivo());
            famProductoSer.mantenimientoData(entity);

            message = "MSG_0002"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") Integer id){
        try {
            if(!famProductoSer.existsById(id)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

            }else{
                famProductoSer.delete(id);
                message = "MSG_0003"; status = HttpStatus.OK;
            }
            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}