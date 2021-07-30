package com.softpang.apiAvikarMantenimiento.Modelo;

public class RolModelDto {

    private Long rol;
    private String descripcion;
    private Integer orden;
    private Integer activo;

    public RolModelDto() {
    }

    public RolModelDto(String descripcion, Integer orden, Integer activo) {
        this.descripcion = descripcion;
        this.orden = orden;
        this.activo = activo;
    }

    public Long getRol() {
        return rol;
    }

    public void setRol(Long rol) {
        this.rol = rol;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getOrden() {
        return orden;
    }

    public void setOrden(Integer orden) {
        this.orden = orden;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }
}
