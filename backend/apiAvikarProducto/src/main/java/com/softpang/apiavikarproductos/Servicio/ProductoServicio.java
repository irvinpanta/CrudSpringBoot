package com.softpang.apiavikarproductos.Servicio;

import com.softpang.apiavikarproductos.Entity.ProductoEntity;
import com.softpang.apiavikarproductos.Repositorio.ProductoRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class ProductoServicio {

    @Autowired
    private ProductoRepositorio productoRepo;

    public ArrayList<ProductoEntity> listarAll(){
        return (ArrayList<ProductoEntity>) productoRepo.findAll();
    }

    public Optional<ProductoEntity> buscarPorId(int id){
        return productoRepo.findById(id);
    }
    public Optional<ProductoEntity> buscarPorDescripcion(String descripcion){
        return productoRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(ProductoEntity productoEntity){
        productoRepo.save(productoEntity);
    }
    public void delete(int id){
        productoRepo.deleteById(id);
    }
    public boolean existsById(int id){
        return productoRepo.existsById(id);
    }
    public boolean existsByDescripcion(String descripcion){
        return productoRepo.existsByDescripcion(descripcion);
    }
}
