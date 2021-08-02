package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.TipoProductoEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.TipoProductoModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.TipoProductoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Optional;

@RestController
@RequestMapping("/api/tipoproducto")
@CrossOrigin(origins = "http://localhost:8080")
public class TipoProductoControlador {

    @Autowired
    private TipoProductoServicio tipoProductoServicio;

    @GetMapping("/listar")
    public ResponseEntity<TipoProductoEntity> listarAll(){
        ArrayList<TipoProductoEntity> lista = tipoProductoServicio.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<TipoProductoEntity> buscarPorId(@PathVariable("id") int id){
        if (!tipoProductoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        TipoProductoEntity tipoProductoEntity = tipoProductoServicio.buscarPorId(id).get();
        return new ResponseEntity(tipoProductoEntity, HttpStatus.OK);
    }

    @GetMapping("/listar/query/{descripcion}")
    public ResponseEntity<TipoProductoEntity> buscarPorDescripcion(@PathVariable("descripcion") String descripcion){
        if (!tipoProductoServicio.existsByDescripcion(descripcion))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        Optional<TipoProductoEntity> tipoProductoEntity = tipoProductoServicio.buscarPorDescripcion(descripcion);
        return new ResponseEntity(tipoProductoEntity, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody TipoProductoModelDto tipoProDto){

        if(tipoProductoServicio.existsByDescripcion(tipoProDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);
        if (tipoProDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);

        TipoProductoEntity entity = new TipoProductoEntity(tipoProDto.getDescripcion(), tipoProDto.getActivo());
        tipoProductoServicio.mantenimientoData(entity);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody TipoProductoModelDto tipoProDto){

        if(!tipoProductoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(tipoProDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if (tipoProductoServicio.existsByDescripcion(tipoProDto.getDescripcion()) && tipoProductoServicio.buscarPorDescripcion(tipoProDto.getDescripcion()).get().getTipoProducto() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        TipoProductoEntity entity = tipoProductoServicio.buscarPorId(id).get();
        entity.setDescripcion(tipoProDto.getDescripcion());
        entity.setActivo(tipoProDto.getActivo());
        tipoProductoServicio.mantenimientoData(entity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id") int id){

        try {
            if (!tipoProductoServicio.existsById(id))
                return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
            tipoProductoServicio.delete(id);
            return new ResponseEntity("MSG_0003", HttpStatus.OK);
        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }

}
