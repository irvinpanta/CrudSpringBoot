package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.SalonEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.SalonRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class SalonServicio {

    @Autowired
    private SalonRepositorio salonRepo;

    public ArrayList<SalonEntity> listarAll(){
        return (ArrayList<SalonEntity>) salonRepo.findAll();
    }
    public Optional<SalonEntity> buscarPorId(Long salon){
        return salonRepo.findById(salon);
    }
    public Optional<SalonEntity> buscarPorDescripcion(String descripcion){
        return salonRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(SalonEntity salonEntity){
        salonRepo.save(salonEntity);
    }

    public void delete(Long salon){
        salonRepo.deleteById(salon);
    }

    public boolean existsById(Long salon){
        return salonRepo.existsById(salon);
    }

    public boolean existsByDescripcion(String descripcion){
        return salonRepo.existsByDescripcion(descripcion);
    }

}
