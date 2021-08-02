package com.softpang.apiavikarproductos.Modelo;

import lombok.Data;

@Data
public class TipoProductoModelDto {

    private Long tipoProducto;
    private String descripcion;
    private Integer activo;
}
