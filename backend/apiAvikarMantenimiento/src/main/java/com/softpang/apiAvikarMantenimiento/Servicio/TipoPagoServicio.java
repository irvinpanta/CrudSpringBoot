package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.TipoPagoEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.TipoPagoRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class TipoPagoServicio {

    @Autowired
    private TipoPagoRepositorio tipoPagoRepo;

    public ArrayList<TipoPagoEntity> listarAll(){
        return (ArrayList<TipoPagoEntity>) tipoPagoRepo.findAll();
    }

    public Optional<TipoPagoEntity> buscarPorId(Long id){
        return tipoPagoRepo.findById(id);
    }

    public Optional<TipoPagoEntity> buscarPorDescripcion(String descripcion){
        return tipoPagoRepo.findByDescripcion(descripcion);
    }

    public void mantenimientoData(TipoPagoEntity tipoPagoEntity){
        tipoPagoRepo.save(tipoPagoEntity);
    }

    public void delete(Long id){
        tipoPagoRepo.deleteById(id);
    }

    public boolean existsById(Long id){
        return tipoPagoRepo.existsById(id);
    }
    public boolean existsByDescripcion(String descripcion){
        return tipoPagoRepo.existsByDescripcion(descripcion);
    }
}
