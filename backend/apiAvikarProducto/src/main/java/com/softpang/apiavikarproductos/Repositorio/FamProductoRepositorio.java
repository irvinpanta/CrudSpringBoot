package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.FamProductoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import java.util.Optional;

@Repository
public interface FamProductoRepositorio extends CrudRepository<FamProductoEntity, Integer> {

    @Transactional(readOnly = true)
    Optional<FamProductoEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}