package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.FamProductoEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.FamProductoModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.FamProductoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/famproducto")
@CrossOrigin
public class FamProductoControlador {

    @Autowired
    private FamProductoServicio famProductoSer;

    @GetMapping("/listar")
    public ResponseEntity<FamProductoEntity> listarAll(){
        ArrayList<FamProductoEntity> lista = famProductoSer.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<FamProductoEntity> buscarPorId(@PathVariable("id") int id){
        if(!famProductoSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        FamProductoEntity resul = famProductoSer.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody FamProductoModelDto famProDto){
        if(famProductoSer.existsByDescripcion(famProDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);
        if(famProDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        FamProductoEntity entity = new FamProductoEntity(famProDto.getDescripcion(), famProDto.getActivo());
        famProductoSer.mantenimientoData(entity);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody FamProductoModelDto famProDto){
        if(!famProductoSer.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(famProDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(famProductoSer.existsByDescripcion(famProDto.getDescripcion()) && famProductoSer.buscarPorDescripcion(famProDto.getDescripcion()).get().getId() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        FamProductoEntity entity = famProductoSer.buscarPorId(id).get();
        entity.setDescripcion(famProDto.getDescripcion());
        entity.setActivo(famProDto.getActivo());
        famProductoSer.mantenimientoData(entity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id){
        try {
            if(!famProductoSer.existsById(id))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
            famProductoSer.delete(id);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}
