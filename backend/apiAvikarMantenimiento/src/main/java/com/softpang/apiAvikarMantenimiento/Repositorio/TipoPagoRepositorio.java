package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.TipoPagoEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface TipoPagoRepositorio extends CrudRepository<TipoPagoEntity, Long> {

    public Optional<TipoPagoEntity> findByDescripcion(String desripcion);
    public boolean existsByDescripcion(String descripcion);
}
