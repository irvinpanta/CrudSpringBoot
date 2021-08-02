package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.MesaEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.MesaRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class MesaServicio {

    @Autowired
    private MesaRepositorio mesaRepo;

    public ArrayList<MesaEntity> listarAll(){
        return (ArrayList<MesaEntity>) mesaRepo.findAll();
    }

    public Optional<MesaEntity> buscarPorId(int id){
        return mesaRepo.findById(id);
    }

    public Optional<MesaEntity> buscarPorDescripcion(String descripcion){
        return mesaRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(MesaEntity mesa){
        mesaRepo.save(mesa);
    }

    public void delete(int id){
        mesaRepo.deleteById(id);
    }

    public boolean existsById(int id){
        return mesaRepo.existsById(id);
    }

    public boolean existsByDescripcion(String descripcion){
        return mesaRepo.existsByDescripcion(descripcion);
    }
}
