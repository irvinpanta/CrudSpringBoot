package com.softpang.apiavikarproductos.Servicio;

import com.softpang.apiavikarproductos.Entity.AreaDespachoEntity;
import com.softpang.apiavikarproductos.Repositorio.AreaDespachoRepositorio;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.Optional;

@Service
public class AreaDespachoServicio {

    @Autowired
    private AreaDespachoRepositorio areaDespachoRepo;

    public ArrayList<AreaDespachoEntity> listarByArea(int area){
        return areaDespachoRepo.findByAreaArea(area);
    }
    public boolean existsByArea(Integer area){
        return areaDespachoRepo.existsByAreaArea(area);
    }
    public boolean existsByProducto(Integer producto){return areaDespachoRepo.existsByProductoProducto(producto);}
    public boolean existsByIdDespacho(Integer id){return areaDespachoRepo.existsById(id);}

    public void mantenimientoData(AreaDespachoEntity despacho){
        areaDespachoRepo.save(despacho);
    }

    public void delete(Integer iddespacho){
        areaDespachoRepo.deleteById(iddespacho);
    }


}
