package com.softpang.apiavikarproductos.Repositorio;

import com.softpang.apiavikarproductos.Entity.AreaDespachoEntity;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.repository.CrudRepository;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import java.util.ArrayList;
import java.util.Optional;

@Repository
public interface AreaDespachoRepositorio extends CrudRepository<AreaDespachoEntity, Integer> {

    //@Transactional(readOnly = true)
    ArrayList<AreaDespachoEntity> findByAreaArea(int area);
    boolean existsByAreaArea(int area);
    boolean existsByProductoProducto(int producto);
}
