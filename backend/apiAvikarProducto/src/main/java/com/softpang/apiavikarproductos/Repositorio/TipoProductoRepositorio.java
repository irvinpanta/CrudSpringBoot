package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.TipoProductoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface TipoProductoRepositorio extends CrudRepository<TipoProductoEntity, Integer> {

    public Optional<TipoProductoEntity> findByDescripcion(String descripcion);

    public boolean existsByDescripcion(String descripcion);
}