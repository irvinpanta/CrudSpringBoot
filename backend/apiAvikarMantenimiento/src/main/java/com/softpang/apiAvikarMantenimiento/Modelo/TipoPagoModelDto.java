package com.softpang.apiAvikarMantenimiento.Modelo;

public class TipoPagoModelDto {

    private Long tipoPago;
    private String descripcion;
    private Integer activo;
    private Integer requiereEfectivo;
    private Integer requiereNumOperacion;

    public TipoPagoModelDto() {
    }

    public TipoPagoModelDto(String descripcion, Integer activo, Integer requiereEfectivo, Integer requiereNumOperacion) {
        this.descripcion = descripcion;
        this.activo = activo;
        this.requiereEfectivo = requiereEfectivo;
        this.requiereNumOperacion = requiereNumOperacion;
    }

    public Long getTipoPago() {
        return tipoPago;
    }

    public void setTipoPago(Long tipoPago) {
        this.tipoPago = tipoPago;
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

    public Integer getRequiereEfectivo() {
        return requiereEfectivo;
    }

    public void setRequiereEfectivo(Integer requiereEfectivo) {
        this.requiereEfectivo = requiereEfectivo;
    }

    public Integer getRequiereNumOperacion() {
        return requiereNumOperacion;
    }

    public void setRequiereNumOperacion(Integer requiereNumOperacion) {
        this.requiereNumOperacion = requiereNumOperacion;
    }
}
