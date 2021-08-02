package com.softpang.apiavikarproductos.Servicio;

import com.softpang.apiavikarproductos.Entity.TipoProductoEntity;
import com.softpang.apiavikarproductos.Repositorio.TipoProductoRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class TipoProductoServicio {

    @Autowired
    private TipoProductoRepositorio tipoProductoRepo;

    public ArrayList<TipoProductoEntity> listarAll(){
        return (ArrayList<TipoProductoEntity>) tipoProductoRepo.findAll();
    }

    public Optional<TipoProductoEntity> buscarPorId(Integer id){
        return tipoProductoRepo.findById(id);
    }

    public Optional<TipoProductoEntity> buscarPorDescripcion(String descripcion){
        return tipoProductoRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(TipoProductoEntity tipoProductoEntity){
        tipoProductoRepo.save(tipoProductoEntity);
    }

    public void delete(Integer id){
        tipoProductoRepo.deleteById(id);
    }

    public boolean existsById(Integer id){
        return tipoProductoRepo.existsById(id);
    }
    public boolean existsByDescripcion(String descripcion){
        return tipoProductoRepo.existsByDescripcion(descripcion);
    }

}
