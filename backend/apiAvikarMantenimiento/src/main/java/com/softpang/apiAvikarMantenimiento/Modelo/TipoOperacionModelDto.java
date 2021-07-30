package com.softpang.apiAvikarMantenimiento.Modelo;

public class TipoOperacionModelDto {

    private Long tipoOperacion;
    private String descripcion;
    private Integer activo;

    public TipoOperacionModelDto() {
    }

    public TipoOperacionModelDto(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }

    public Long getTipoOperacion() {
        return tipoOperacion;
    }

    public void setTipoOperacion(Long tipoOperacion) {
        this.tipoOperacion = tipoOperacion;
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
