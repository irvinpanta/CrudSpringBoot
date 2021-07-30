package com.softpang.apiAvikarMantenimiento.Repositorio;

import com.softpang.apiAvikarMantenimiento.Entity.SalonEntity;
import org.springframework.data.domain.Sort;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;

import java.util.ArrayList;
import java.util.Optional;

@Repository
public interface SalonRepositorio extends JpaRepository<SalonEntity, Long> {

    Optional<SalonEntity> findByDescripcion(String descripcion);
    boolean existsByDescripcion(String descripcion);

    //@Query(value = "select s from SalonEntity s.de")
    //ArrayList<SalonEntity> ordenarPorDescripcion();
}
