package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.TipoProductoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import java.util.Optional;

@Repository
public interface TipoProductoRepositorio extends CrudRepository<TipoProductoEntity, Integer> {

    @Transactional(readOnly = true)
    public Optional<TipoProductoEntity> findByDescripcion(String descripcion);

    public boolean existsByDescripcion(String descripcion);
}