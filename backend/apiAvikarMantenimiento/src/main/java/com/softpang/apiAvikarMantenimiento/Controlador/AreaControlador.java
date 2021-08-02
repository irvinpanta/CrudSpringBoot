package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.AreaEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.AreaModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.AreaServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/areas")
@CrossOrigin
public class AreaControlador {

    @Autowired
    private AreaServicio areaSer;

    @GetMapping("/listar")
    public ResponseEntity<ArrayList<AreaEntity>> listarAll(){
        ArrayList<AreaEntity> lista = areaSer.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<AreaEntity> buscarPorId(@PathVariable("id") int id){
        if(!areaSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        AreaEntity resul = areaSer.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody AreaModelDto areaDto){
        if(areaSer.existsByDescripcion(areaDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);
        if(areaDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);

        AreaEntity entity = new AreaEntity(areaDto.getDescripcion(), areaDto.getActivo());
        areaSer.mantenimientoData(entity);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);

    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody AreaModelDto areaDto){
        if(!areaSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(areaDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.BAD_REQUEST);
        if(areaSer.existsByDescripcion(areaDto.getDescripcion()) && areaSer.buscarPorDescripcion(areaDto.getDescripcion()).get().getArea() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.BAD_REQUEST);

        AreaEntity entity = areaSer.buscarPorId(id).get();
        entity.setDescripcion(areaDto.getDescripcion());
        entity.setActivo(areaDto.getActivo());
        areaSer.mantenimientoData(entity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/deelete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id){
        if(!areaSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        areaSer.delete(id);
        return new ResponseEntity("MSG_0003", HttpStatus.OK);
    }
}
