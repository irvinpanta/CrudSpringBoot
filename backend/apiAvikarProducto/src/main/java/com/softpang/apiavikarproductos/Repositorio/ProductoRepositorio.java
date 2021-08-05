package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.ProductoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import java.util.Optional;

@Repository
public interface ProductoRepositorio extends CrudRepository<ProductoEntity, Integer> {

    @Transactional(readOnly = true)
    Optional<ProductoEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}
