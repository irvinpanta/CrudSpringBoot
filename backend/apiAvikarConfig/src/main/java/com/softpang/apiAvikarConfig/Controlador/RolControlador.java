package com.softpang.apiAvikarConfig.Controlador;

import com.softpang.apiAvikarConfig.Entity.RolEntity;
import com.softpang.apiAvikarConfig.Modelo.RolModelDto;
import com.softpang.apiAvikarConfig.Servicio.RolServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/roles")
@CrossOrigin
public class RolControlador {

    @Autowired
    private RolServicio rolServicio;

    private String message = "";
    private HttpStatus status;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<RolEntity>> listarAll(){

        ArrayList<RolEntity> list = rolServicio.listar();
        return new ResponseEntity(list, HttpStatus.OK);
    }

    @GetMapping("/listar/{rol}")
    public ResponseEntity<RolEntity> listarPorId(@PathVariable("rol") Integer rol){

        if (!rolServicio.existePorId(rol)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;
            return new ResponseEntity(message, status);
        }else{
            RolEntity rolEntity = rolServicio.obtenerPorId(rol).get();
            return new ResponseEntity(rolEntity, HttpStatus.OK);
        }

    }

    @PostMapping("/save")
    public ResponseEntity<?> guardar(@RequestBody RolModelDto rolDto){

        if (rolDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if (rolServicio.existePorDescripcion(rolDto.getDescripcion())){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else{
            RolEntity rol = new RolEntity(rolDto.getDescripcion(), rolDto.getOrden(), rolDto.getActivo());
            rolServicio.mantenimientoData(rol);
            message = "MSG_0001"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @PutMapping("/update/{rol}")
    public  ResponseEntity<?> update(@PathVariable("rol") Integer rol, @RequestBody RolModelDto rolDto){

        if(!rolServicio.existePorId(rol)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else if (rolDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if (rolServicio.existePorDescripcion(rolDto.getDescripcion()) && rolServicio.obtenerByDescripcion(rolDto.getDescripcion()).get().getRol() != rol){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else{
            RolEntity rolEntity = rolServicio.obtenerPorId(rol).get();

            rolEntity.setDescripcion(rolDto.getDescripcion());
            rolEntity.setOrden(rolDto.getOrden());
            rolEntity.setActivo(rolDto.getActivo());
            rolServicio.mantenimientoData(rolEntity);

            message = "MSG_0002"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{rol}")
    public ResponseEntity<?> delete(@PathVariable("rol") Integer rol){

        try {
            if (!rolServicio.existePorId(rol)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;
            }else{
                rolServicio.delete(rol);
                message = "MSG_0003"; status = HttpStatus.OK;
            }
            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}

