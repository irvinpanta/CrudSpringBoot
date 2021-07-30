package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.SalonEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.SalonModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.SalonServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Optional;

@RestController
@RequestMapping("/api/salones")
@CrossOrigin(origins = "http://localhost:8080")
public class SalonControlador {

    @Autowired
    private SalonServicio salonServicio;

    @GetMapping("/listar")
    public ResponseEntity<SalonEntity> listarAll(){
        ArrayList<SalonEntity> lista = salonServicio.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{salon}")
    public ResponseEntity<SalonEntity> listarPorId(@PathVariable("salon") Long salon){
        if (!salonServicio.existsById(salon))
            return new ResponseEntity("Salon no existe", HttpStatus.NOT_FOUND);

        SalonEntity salonEntity = salonServicio.buscarPorId(salon).get();
        return new ResponseEntity(salonEntity, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody SalonModelDto salonDto){

        if(salonDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(salonServicio.existsByDescripcion(salonDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        SalonEntity salonEntity = new SalonEntity(salonDto.getDescripcion(), salonDto.getCapacidad(), salonDto.getActivo());
        salonServicio.mantenimientoData(salonEntity);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{salon}")
    public ResponseEntity<?> update(@PathVariable("salon") Long salon, @RequestBody SalonModelDto salonDto){

        if(!salonServicio.existsById(salon))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(salonDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        if (salonServicio.existsByDescripcion(salonDto.getDescripcion()) && salonServicio.buscarPorDescripcion(salonDto.getDescripcion()).get().getSalon() != salon)
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        SalonEntity salonEntity = salonServicio.buscarPorId(salon).get();
        salonEntity.setDescripcion(salonDto.getDescripcion());
        salonEntity.setCapacidad(salonDto.getCapacidad());
        salonEntity.setActivo(salonDto.getActivo());
        salonServicio.mantenimientoData(salonEntity);

        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{salon}")
    public ResponseEntity<?> delete(@PathVariable("salon") Long salon){
        if(!salonServicio.existsById(salon))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        salonServicio.delete(salon);
        return new ResponseEntity("MSG_0003", HttpStatus.OK);
    }
}
