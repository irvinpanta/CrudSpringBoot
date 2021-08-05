package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.AreaEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import java.util.Optional;

@Repository
public interface AreaRepositorio extends CrudRepository<AreaEntity, Integer> {

    @Transactional(readOnly = true)
    Optional<AreaEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}