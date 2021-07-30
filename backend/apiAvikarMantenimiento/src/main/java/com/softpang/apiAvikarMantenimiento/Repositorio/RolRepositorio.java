package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.RolEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface RolRepositorio extends CrudRepository<RolEntity, Long> {

    boolean existsByDescripcion(String descripcion);
    Optional<RolEntity> findByDescripcion(String descripcion);
}
