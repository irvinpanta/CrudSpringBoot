package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.EmpleadoEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.EmpleadoRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.PathVariable;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class EmpleadoServicio {

    @Autowired
    private EmpleadoRepositorio empleadoRepo;

    public ArrayList<EmpleadoEntity> listarAll(){
        return (ArrayList<EmpleadoEntity>) empleadoRepo.findAll();
    }

    public Optional<EmpleadoEntity> buscarPorId(int id){
        return empleadoRepo.findById(id);
    }

    public Optional<EmpleadoEntity> buscarPorNumeroDocumento(String dni){
        return empleadoRepo.findByNumerodocumento(dni);
    }
    public void mantenimientoData(EmpleadoEntity empleado){
        empleadoRepo.save(empleado);
    }

    public void delete(Integer id){
        empleadoRepo.deleteById(id);
    }

    public boolean existsById(Integer id){
        return empleadoRepo.existsById(id);
    }

    public boolean existsByDni(String dni){
        return empleadoRepo.existsByNumerodocumento(dni);
    }
}
