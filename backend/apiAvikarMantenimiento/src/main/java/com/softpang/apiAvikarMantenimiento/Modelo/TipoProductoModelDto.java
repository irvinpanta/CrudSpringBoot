package com.softpang.apiAvikarMantenimiento.Modelo;

public class TipoProductoModelDto {

    private Long tipoProducto;
    private String descripcion;
    private Integer activo;

    public TipoProductoModelDto() {
    }

    public TipoProductoModelDto(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }

    public Long getTipoProducto() {
        return tipoProducto;
    }

    public void setTipoProducto(Long tipoProducto) {
        this.tipoProducto = tipoProducto;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }
}
