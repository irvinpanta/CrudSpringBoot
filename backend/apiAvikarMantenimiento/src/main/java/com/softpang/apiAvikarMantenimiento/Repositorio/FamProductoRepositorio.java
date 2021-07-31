package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.FamProductoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface FamProductoRepositorio extends CrudRepository<FamProductoEntity, Integer> {

    Optional<FamProductoEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}
