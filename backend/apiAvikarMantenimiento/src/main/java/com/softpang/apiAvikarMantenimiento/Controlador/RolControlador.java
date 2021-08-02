package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.RolEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.RolModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.RolServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/roles")
@CrossOrigin(origins = "http://localhost:8080")
public class RolControlador {

    @Autowired
    private RolServicio rolServicio;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<RolEntity>> listarAll(){
        ArrayList<RolEntity> list = rolServicio.listar();
        return new ResponseEntity(list, HttpStatus.OK);
    }

    @GetMapping("/listar/{rol}")
    public ResponseEntity<RolEntity> listarPorId(@PathVariable("rol") Long rol){
        if (!rolServicio.existePorId(rol))
            return new ResponseEntity("Rol no existe", HttpStatus.NOT_FOUND);

        RolEntity rolEntity = rolServicio.obtenerPorId(rol).get();
        return new ResponseEntity(rolEntity, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> guardar(@RequestBody RolModelDto rolDto){

        if (rolDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);

        if (rolServicio.existePorDescripcion(rolDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);

        RolEntity rol = new RolEntity(rolDto.getDescripcion(), rolDto.getOrden(), rolDto.getActivo());
        rolServicio.mantenimientoData(rol);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{rol}")
    public  ResponseEntity<?> update(@PathVariable("rol") Long rol, @RequestBody RolModelDto rolDto){
        if(!rolServicio.existePorId(rol))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        if (rolDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if (rolServicio.existePorDescripcion(rolDto.getDescripcion()) && rolServicio.obtenerByDescripcion(rolDto.getDescripcion()).get().getRol() != rol)
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);

        RolEntity rolEntity = rolServicio.obtenerPorId(rol).get();

        rolEntity.setDescripcion(rolDto.getDescripcion());
        rolEntity.setOrden(rolDto.getOrden());
        rolEntity.setActivo(rolDto.getActivo());
        rolServicio.mantenimientoData(rolEntity);

        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{rol}")
    public ResponseEntity<?> delete(@PathVariable("rol") Long rol){

        try {
            if (!rolServicio.existePorId(rol))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
            rolServicio.delete(rol);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }



}
