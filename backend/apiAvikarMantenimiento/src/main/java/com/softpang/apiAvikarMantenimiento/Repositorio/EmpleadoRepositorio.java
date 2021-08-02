package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.EmpleadoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface EmpleadoRepositorio extends CrudRepository<EmpleadoEntity, Integer> {

    Optional<EmpleadoEntity> findByNumerodocumento(String dni);
    boolean existsByNumerodocumento(String dni);

}
