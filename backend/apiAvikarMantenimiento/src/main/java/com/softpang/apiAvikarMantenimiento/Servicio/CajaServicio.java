package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.CajaEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.CajaRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class CajaServicio {

    @Autowired
    private CajaRepositorio cajaRepo;

    public ArrayList<CajaEntity> listarAll(){
        return (ArrayList<CajaEntity>) cajaRepo.findAll();
    }

    public Optional<CajaEntity> buscarPorId(Long caja){
        return cajaRepo.findById(caja);
    }

    public Optional<CajaEntity> buscarPorDescripcion(String descripcion){
        return cajaRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(CajaEntity caja){
        cajaRepo.save(caja);
    }

    public void delete(Long caja){
        cajaRepo.deleteById(caja);
    }

    public boolean existsById(Long caja){
        return cajaRepo.existsById(caja);
    }
    public boolean existsByDescripcion(String descripcion){
        return cajaRepo.existsByDescripcion(descripcion);
    }
}
