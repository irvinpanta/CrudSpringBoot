package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.TipoPagoEntity;
import com.softpang.apiAvikarMantenimiento.Entity.TipoProductoEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.TipoProductoRepositorio;
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

    public Optional<TipoProductoEntity> buscarPorId(Long id){
        return tipoProductoRepo.findById(id);
    }

    public Optional<TipoProductoEntity> buscarPorDescripcion(String descripcion){
        return tipoProductoRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(TipoProductoEntity tipoProductoEntity){
        tipoProductoRepo.save(tipoProductoEntity);
    }

    public void delete(Long id){
        tipoProductoRepo.deleteById(id);
    }

    public boolean existsById(Long id){
        return tipoProductoRepo.existsById(id);
    }
    public boolean existsByDescripcion(String descripcion){
        return tipoProductoRepo.existsByDescripcion(descripcion);
    }

}
