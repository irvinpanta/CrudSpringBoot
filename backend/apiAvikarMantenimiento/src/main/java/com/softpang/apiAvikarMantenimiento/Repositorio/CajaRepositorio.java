package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.CajaEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface CajaRepositorio extends CrudRepository<CajaEntity, Long> {

    Optional<CajaEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}
