package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.AreaEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface AreaRepositorio extends CrudRepository<AreaEntity, Integer> {

    Optional<AreaEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}
