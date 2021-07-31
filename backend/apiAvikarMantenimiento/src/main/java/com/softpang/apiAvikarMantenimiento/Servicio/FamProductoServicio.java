package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.FamProductoEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.FamProductoRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class FamProductoServicio {

    @Autowired
    private FamProductoRepositorio famProductoRepo;

    public ArrayList<FamProductoEntity> listarAll(){
        return (ArrayList<FamProductoEntity>) famProductoRepo.findAll();
    }
    public Optional<FamProductoEntity> buscarPorId(Integer id){
        return famProductoRepo.findById(id);
    }

    public Optional<FamProductoEntity> buscarPorDescripcion(String descripcion){
        return famProductoRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(FamProductoEntity famProEntity){
        famProductoRepo.save(famProEntity);
    }

    public void delete(Integer id){
        famProductoRepo.deleteById(id);
    }

    public boolean existsById(Integer id){
        return famProductoRepo.existsById(id);
    }

    public boolean existsByDescripcion(String descripcion){
        return famProductoRepo.existsByDescripcion(descripcion);
    }
}
