package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.RolEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.RolRepositorio;
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
    public Optional<RolEntity> obtenerPorId(Long rol){ return rolRepo.findById(rol); }
    public Optional<RolEntity> obtenerByDescripcion(String descripcion){
        return rolRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(RolEntity rol){
        rolRepo.save(rol);
    }

    public void delete(Long rol){
        rolRepo.deleteById(rol);
    }

    public boolean existePorId(Long rol){
        return rolRepo.existsById(rol);
    }
    public boolean existePorDescripcion(String descripcion){
        return rolRepo.existsByDescripcion(descripcion);
    }

}
