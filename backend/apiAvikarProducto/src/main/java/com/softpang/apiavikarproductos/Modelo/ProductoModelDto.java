package com.softpang.apiavikarproductos.Modelo;

import com.softpang.apiavikarproductos.Entity.FamProductoEntity;
import com.softpang.apiavikarproductos.Entity.TipoProductoEntity;
import lombok.Data;

@Data
public class ProductoModelDto {

    private Integer producto;
    private String descripcion;
    private Integer stock;
    private Double precio;
    private Integer activo;


    private FamProductoEntity famproducto;
    private TipoProductoEntity tipoProducto;
}
