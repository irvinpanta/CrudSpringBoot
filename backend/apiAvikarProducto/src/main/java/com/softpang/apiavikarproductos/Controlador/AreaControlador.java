package com.softpang.apiavikarproductos.Controlador;

import com.softpang.apiavikarproductos.Entity.AreaEntity;
import com.softpang.apiavikarproductos.Modelo.AreaModelDto;
import com.softpang.apiavikarproductos.Servicio.AreaServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/areas")
@CrossOrigin(origins = "http://localhost:8081")
public class AreaControlador {

    @Autowired
    private AreaServicio areaSer;

    private String message = "";
    private HttpStatus status;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<AreaEntity>> listarAll(){
        ArrayList<AreaEntity> lista = areaSer.listarAll();

        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<AreaEntity> buscarPorId(@PathVariable("id") Integer id){

        if(!areaSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        AreaEntity resul = areaSer.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody AreaModelDto areaDto){

        if(areaSer.existsByDescripcion(areaDto.getDescripcion())){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else if(areaDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else{
            AreaEntity entity = new AreaEntity(areaDto.getDescripcion(), areaDto.getActivo());
            areaSer.mantenimientoData(entity);

            message = "MSG_0001"; status = HttpStatus.OK;
        }

        return new ResponseEntity(message, status);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") Integer id, @RequestBody AreaModelDto areaDto){

        if(!areaSer.existsById(id)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else if(areaDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if(areaSer.existsByDescripcion(areaDto.getDescripcion()) && areaSer.buscarPorDescripcion(areaDto.getDescripcion()).get().getArea() != id){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;
        }else{
            AreaEntity entity = areaSer.buscarPorId(id).get();
            entity.setDescripcion(areaDto.getDescripcion());
            entity.setActivo(areaDto.getActivo());
            areaSer.mantenimientoData(entity);

            message = "MSG_0002"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") Integer id){

        try {
            if(!areaSer.existsById(id)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;
            }else{
                areaSer.delete(id);
                message = "MSG_0003"; status = HttpStatus.OK;
            }
            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.BAD_REQUEST);
        }

    }
}
