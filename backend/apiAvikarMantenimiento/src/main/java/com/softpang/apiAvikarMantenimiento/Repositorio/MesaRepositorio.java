package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.MesaEntity;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface MesaRepositorio extends CrudRepository<MesaEntity, Integer> {

    Optional<MesaEntity> findByDescripcion(String desripcion);
    boolean existsByDescripcion(String descripcion);
}
