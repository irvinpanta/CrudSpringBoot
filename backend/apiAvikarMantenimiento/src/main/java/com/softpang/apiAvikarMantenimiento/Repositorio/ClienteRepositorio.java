package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.ClienteEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface ClienteRepositorio extends CrudRepository<ClienteEntity, Integer> {

    Optional<ClienteEntity> findByNumerodocumento(String dni);
    boolean existsByNumerodocumento(String dni);
}
