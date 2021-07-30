package com.softpang.apiAvikarMantenimiento.Modelo;

public class SalonModelDto {

    private Long salon;
    private String descripcion;
    private Integer capacidad;
    private Integer activo;

    public SalonModelDto() {
    }

    public SalonModelDto(String descripcion, Integer capacidad, Integer activo) {
        this.descripcion = descripcion;
        this.capacidad = capacidad;
        this.activo = activo;
    }

    public Long getSalon() {
        return salon;
    }

    public void setSalon(Long salon) {
        this.salon = salon;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getCapacidad() {
        return capacidad;
    }

    public void setCapacidad(Integer capacidad) {
        this.capacidad = capacidad;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }
}
