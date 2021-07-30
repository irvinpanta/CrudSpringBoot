package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.TipoOperacionEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.TipoOperacionRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class TipoOperacionServicio {

    @Autowired
    private TipoOperacionRepositorio tipoOperacionRepo;

    public ArrayList<TipoOperacionEntity> listarAll(){
        return (ArrayList<TipoOperacionEntity>) tipoOperacionRepo.findAll();
    }
    public Optional<TipoOperacionEntity> buscarPorId(Long tipoOpera){
        return tipoOperacionRepo.findById(tipoOpera);
    }
    public Optional<TipoOperacionEntity> buscarPorDescripcion(String descripcion){
        return tipoOperacionRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(TipoOperacionEntity operacionEntity){
        tipoOperacionRepo.save(operacionEntity);
    }

    public void delete(Long tipoOpera){
        tipoOperacionRepo.deleteById(tipoOpera);
    }

    public boolean existsById(Long tipoOpera){
        return tipoOperacionRepo.existsById(tipoOpera);
    }

    public boolean existsByDescripcion(String descripcion){
        return tipoOperacionRepo.existsByDescripcion(descripcion);
    }
}
