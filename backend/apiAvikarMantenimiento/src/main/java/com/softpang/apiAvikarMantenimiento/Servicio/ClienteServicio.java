package com.softpang.apiAvikarMantenimiento.Servicio;

import com.softpang.apiAvikarMantenimiento.Entity.ClienteEntity;
import com.softpang.apiAvikarMantenimiento.Repositorio.ClienteRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class ClienteServicio {

    @Autowired
    private ClienteRepositorio clienteRepo;

    public ArrayList<ClienteEntity> listarAll(){
        return (ArrayList<ClienteEntity>) clienteRepo.findAll();
    }

    public Optional<ClienteEntity> buscarPorId(int id){
        return clienteRepo.findById(id);
    }

    public Optional<ClienteEntity> buscarPorDni(String dni){
        return clienteRepo.findByNumerodocumento(dni);
    }

    public void mantenimientoData(ClienteEntity cliente){
        clienteRepo.save(cliente);
    }

    public void delete(int id){
        clienteRepo.deleteById(id);
    }

    public boolean existsById(int id){
        return clienteRepo.existsById(id);
    }

    public boolean existsByDni(String dni){
        return clienteRepo.existsByNumerodocumento(dni);
    }
}
