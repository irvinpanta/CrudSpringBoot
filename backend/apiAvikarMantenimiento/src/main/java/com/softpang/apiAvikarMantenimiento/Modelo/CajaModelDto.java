package com.softpang.apiAvikarMantenimiento.Modelo;

public class CajaModelDto {

    private Long caja;
    private String descripcion;
    private Integer activo;

    public CajaModelDto() {
    }

    public CajaModelDto(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }

    public Long getCaja() {
        return caja;
    }

    public void setCaja(Long caja) {
        this.caja = caja;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String desripcion) {
        this.descripcion = desripcion;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }
}
