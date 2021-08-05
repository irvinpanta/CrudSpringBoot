package com.softpang.apiavikarproductos.Controlador;

import com.softpang.apiavikarproductos.Entity.ProductoEntity;
import com.softpang.apiavikarproductos.Modelo.ProductoModelDto;
import com.softpang.apiavikarproductos.Servicio.FamProductoServicio;
import com.softpang.apiavikarproductos.Servicio.ProductoServicio;
import com.softpang.apiavikarproductos.Servicio.TipoProductoServicio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;

@RestController
@RequestMapping("/api/producto")
@CrossOrigin(origins = "http://localhost:8081")
public class ProductoControlador {

    @Autowired
    private ProductoServicio productoServicio;
    @Autowired
    private TipoProductoServicio tipoProductoServicio;
    @Autowired
    private FamProductoServicio famProductoServicio;

    private String message = "";
    private HttpStatus status;

    @GetMapping("/listar")
    public ResponseEntity<ProductoEntity> listarAll(){
        ArrayList<ProductoEntity> lista = productoServicio.listarAll();
        return new ResponseEntity(lista, HttpStatus.OK);
    }

    @GetMapping("/listar/{id}")
    public ResponseEntity<ProductoEntity> buscarPorId(@PathVariable("id") Integer id){
        if(!productoServicio.existsById(id))
            return new ResponseEntity("MSG_0006", HttpStatus.OK);
        ProductoEntity resul = productoServicio.buscarPorId(id).get();
        return new ResponseEntity(resul, HttpStatus.OK);
    }

    @PostMapping("/save")
    public ResponseEntity<?> save(@RequestBody ProductoModelDto productoDto){

        if(productoServicio.existsByDescripcion(productoDto.getDescripcion())){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else if(productoDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if(productoDto.getStock() <= 0){
            message = "MSG_P001"; status = HttpStatus.BAD_REQUEST;

        }else if(productoDto.getPrecio() <= 0){
            message = "MSG_P002"; status = HttpStatus.BAD_REQUEST;

        }else if((!tipoProductoServicio.existsById(productoDto.getTipoProducto().getTipoProducto())) ||
                (!famProductoServicio.existsById(productoDto.getFamproducto().getId()))){

            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;
        }else{
            ProductoEntity entity = new ProductoEntity(
                    productoDto.getDescripcion(),
                    productoDto.getStock(),
                    productoDto.getPrecio(),
                    productoDto.getActivo(),
                    productoDto.getFamproducto(),
                    productoDto.getTipoProducto());

            productoServicio.mantenimientoData(entity);
            message = "MSG_0001"; status = HttpStatus.OK;

        }
        return new ResponseEntity(message, status);
    }

    @PutMapping("/update/{id}")
    public ResponseEntity<?> update(@PathVariable("id") Integer id, @RequestBody ProductoModelDto productoDto){

        if(!productoServicio.existsById(id)){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else if(productoDto.getDescripcion() == ""){
            message = "MSG_0040"; status = HttpStatus.BAD_REQUEST;

        }else if(productoDto.getStock() <= 0){
            message = "MSG_P001"; status = HttpStatus.BAD_REQUEST;

        }else if(productoDto.getPrecio() <= 0){
            message = "MSG_P002"; status = HttpStatus.BAD_REQUEST;

        }else if(productoServicio.existsByDescripcion(productoDto.getDescripcion()) && productoServicio.buscarPorDescripcion(productoDto.getDescripcion()).get().getProducto() != id){
            message = "MSG_0005"; status = HttpStatus.BAD_REQUEST;

        }else if((!tipoProductoServicio.existsById(productoDto.getTipoProducto().getTipoProducto())) ||
                (!famProductoServicio.existsById(productoDto.getFamproducto().getId()))){
            message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

        }else{
            ProductoEntity entity = productoServicio.buscarPorId(id).get();
            entity.setDescripcion(productoDto.getDescripcion());
            entity.setStock(productoDto.getStock());
            entity.setPrecio(productoDto.getPrecio());
            entity.setActivo(productoDto.getActivo());
            entity.setTipoProducto(productoDto.getTipoProducto());
            entity.setFamproducto(productoDto.getFamproducto());

            productoServicio.mantenimientoData(entity);
            message = "MSG_0002"; status = HttpStatus.OK;
        }
        return new ResponseEntity(message, status);
    }

    @DeleteMapping("/delete/{id}")
    public ResponseEntity<?> delete(@PathVariable("id")Integer id){

        try {

            if(!productoServicio.existsById(id)){
                message = "MSG_0006"; status = HttpStatus.NOT_FOUND;

            }else{
                productoServicio.delete(id);
                message = "MSG_0003"; status = HttpStatus.OK;
            }
            return new ResponseEntity(message, status);

        }catch (Exception ex){
            return new ResponseEntity("MSG_0030", HttpStatus.CONFLICT);
        }

    }
}
