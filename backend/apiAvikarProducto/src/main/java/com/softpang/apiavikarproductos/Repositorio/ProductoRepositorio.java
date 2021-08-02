package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.ProductoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface ProductoRepositorio extends CrudRepository<ProductoEntity, Integer> {

    Optional<ProductoEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);
}
