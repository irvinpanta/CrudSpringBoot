package com.softpang.apiAvikarConfig.Repositorio;

import com.softpang.apiAvikarConfig.Entity.RolEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface RolRepositorio extends CrudRepository<RolEntity, Integer> {

    boolean existsByDescripcion(String descripcion);
    Optional<RolEntity> findByDescripcion(String descripcion);
}

