package com.softpang.apiavikarproductos.Servicio;

import com.softpang.apiavikarproductos.Entity.AreaEntity;
import com.softpang.apiavikarproductos.Repositorio.AreaRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class AreaServicio {

    @Autowired
    private AreaRepositorio areaRepo;

    public ArrayList<AreaEntity> listarAll(){
        return (ArrayList<AreaEntity>) areaRepo.findAll();
    }

    public Optional<AreaEntity> buscarPorId(int id){
        return areaRepo.findById(id);
    }

    public Optional<AreaEntity> buscarPorDescripcion(String descripcion){
        return areaRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(AreaEntity entity){
        areaRepo.save(entity);
    }

    public void delete(int id){
        areaRepo.deleteById(id);
    }

    public boolean existsById(int id){
        return areaRepo.existsById(id);
    }

    public boolean existsByDescripcion(String descripcion){
        return areaRepo.existsByDescripcion(descripcion);
    }


}
