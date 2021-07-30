package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.TipoOperacionEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface TipoOperacionRepositorio extends CrudRepository<TipoOperacionEntity, Long> {

    public Optional<TipoOperacionEntity> findByDescripcion(String descripcion);
    public boolean existsByDescripcion(String descripcion);
}
