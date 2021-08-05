package com.softpang.apiAvikarConfig.Servicio;

import com.softpang.apiAvikarConfig.Entity.RolEntity;
import com.softpang.apiAvikarConfig.Repositorio.RolRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class RolServicio {

    @Autowired
    private RolRepositorio rolRepo;

    public ArrayList<RolEntity> listar(){
        return (ArrayList<RolEntity>) rolRepo.findAll();
    }
    public Optional<RolEntity> obtenerPorId(Integer rol){ return rolRepo.findById(rol); }
    public Optional<RolEntity> obtenerByDescripcion(String descripcion){
        return rolRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(RolEntity rol){
        rolRepo.save(rol);
    }

    public void delete(Integer rol){
        rolRepo.deleteById(rol);
    }

    public boolean existePorId(Integer rol){
        return rolRepo.existsById(rol);
    }
    public boolean existePorDescripcion(String descripcion){
        return rolRepo.existsByDescripcion(descripcion);
    }

}
