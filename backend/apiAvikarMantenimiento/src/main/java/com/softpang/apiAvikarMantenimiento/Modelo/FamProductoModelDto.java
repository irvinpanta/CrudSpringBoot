package com.softpang.apiAvikarMantenimiento.Modelo;

public class FamProductoModelDto {

    private Integer id;
    private String descripcion;
    private Integer activo;

    public FamProductoModelDto() {
    }

    public FamProductoModelDto(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
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
