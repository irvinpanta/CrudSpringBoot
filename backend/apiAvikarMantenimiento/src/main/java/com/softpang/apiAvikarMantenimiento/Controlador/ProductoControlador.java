package com.softpang.apiAvikarMantenimiento.Controlador;

import com.softpang.apiAvikarMantenimiento.Entity.ProductoEntity;
import com.softpang.apiAvikarMantenimiento.Modelo.ProductoModelDto;
import com.softpang.apiAvikarMantenimiento.Servicio.FamProductoServicio;
import com.softpang.apiAvikarMantenimiento.Servicio.ProductoServicio;
import com.softpang.apiAvikarMantenimiento.Servicio.TipoProductoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/producto")
@CrossOrigin
public class ProductoControlador {

    @Autowired
    private ProductoServicio productoServicio;
    @Autowired
    private TipoProductoServicio tipoProductoServicio;
    @Autowired
    private FamProductoServicio famProductoServicio;

    @GetMapping("/listar")
    public ResponseEntity<ProductoEntity> listarAll(){
        ArrayList<ProductoEntity> lista = productoServicio.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<ProductoEntity> buscarPorId(@PathVariable("id") int id){
        if(!productoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.OK);
        ProductoEntity resul = productoServicio.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody ProductoModelDto productoDto){

        if(productoServicio.existsByDescripcion(productoDto.getDescripcion()))
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);
        if(productoDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(productoDto.getStock() <= 0)
            return new ResponseEntity("MSG_P001", HttpStatus.NOT_FOUND);
        if(productoDto.getPrecio() <= 0)
            return new ResponseEntity("MSG_P002", HttpStatus.NOT_FOUND);

        if(!tipoProductoServicio.existsById(productoDto.getTipoProducto().getTipoProducto()))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(!famProductoServicio.existsById(productoDto.getFamproducto().getId()))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);


        ProductoEntity entity = new ProductoEntity(productoDto.getDescripcion(), productoDto.getStock(), productoDto.getPrecio(), productoDto.getActivo(), productoDto.getFamproducto(), productoDto.getTipoProducto());
        productoServicio.mantenimientoData(entity);
        return new ResponseEntity("MSG_0001", HttpStatus.OK);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") int id, @RequestBody ProductoModelDto productoDto){
        if(!productoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(productoDto.getDescripcion() == "")
            return new ResponseEntity("MSG_0040", HttpStatus.NOT_FOUND);
        if(productoDto.getStock() <= 0)
            return new ResponseEntity("MSG_P001", HttpStatus.NOT_FOUND);
        if(productoDto.getPrecio() <= 0)
            return new ResponseEntity("MSG_P002", HttpStatus.NOT_FOUND);

        if(productoServicio.existsByDescripcion(productoDto.getDescripcion()) && productoServicio.buscarPorDescripcion(productoDto.getDescripcion()).get().getProducto() != id)
            return new ResponseEntity("MSG_0005", HttpStatus.NOT_FOUND);

        if(!tipoProductoServicio.existsById(productoDto.getTipoProducto().getTipoProducto()))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        if(!famProductoServicio.existsById(productoDto.getFamproducto().getId()))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);

        ProductoEntity entity = productoServicio.buscarPorId(id).get();
        entity.setDescripcion(productoDto.getDescripcion());
        entity.setStock(productoDto.getStock());
        entity.setPrecio(productoDto.getPrecio());
        entity.setActivo(productoDto.getActivo());
        entity.setTipoProducto(productoDto.getTipoProducto());
        entity.setFamproducto(productoDto.getFamproducto());

        productoServicio.mantenimientoData(entity);
        return new ResponseEntity("MSG_0002", HttpStatus.OK);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id")int id){
        if(!productoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.NOT_FOUND);
        productoServicio.delete(id);
        return new ResponseEntity("MSG_0003", HttpStatus.OK);
    }
}
