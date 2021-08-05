package com.softpang.apiavikarproductos.Modelo;

import com.softpang.apiavikarproductos.Entity.AreaEntity;
import com.softpang.apiavikarproductos.Entity.ProductoEntity;
import lombok.Data;

@Data
public class AreaDespachoModelDto {

    private Integer despacho;
    private ProductoEntity producto;
    private AreaEntity area;
}
