package com.softpang.apiAvikarMantenimiento.Modelo;

import com.softpang.apiAvikarMantenimiento.Entity.SalonEntity;

public class MesaModelDto {

    private Integer mesa;
    private String descripcion;
    private Integer cantidad;
    private Integer activo;
    private Integer mesarapida;
    private SalonEntity salon;

    public MesaModelDto() {
    }

    public MesaModelDto(String descripcion, Integer cantidad, Integer activo, Integer mesarapida, SalonEntity salon) {
        this.descripcion = descripcion;
        this.cantidad = cantidad;
        this.activo = activo;
        this.mesarapida = mesarapida;
        this.salon = salon;
    }

    public Integer getMesa() {
        return mesa;
    }

    public void setMesa(Integer mesa) {
        this.mesa = mesa;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getCantidad() {
        return cantidad;
    }

    public void setCantidad(Integer cantidad) {
        this.cantidad = cantidad;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }

    public Integer getMesarapida() {
        return mesarapida;
    }

    public void setMesarapida(Integer mesarapida) {
        this.mesarapida = mesarapida;
    }

    public SalonEntity getSalon() {
        return salon;
    }

    public void setSalon(SalonEntity salon) {
        this.salon = salon;
    }
}
