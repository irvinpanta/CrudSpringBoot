package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;

@Entity
@Table(name = "tipopago")
public class TipoPagoEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long tipoPago;

    @Column(length = 50, nullable = false, unique = true)
    private String descripcion;
    @Column(length = 1)
    private Integer activo;
    @Column(length = 1)
    private Integer requiereEfectivo;
    @Column(length = 1)
    private Integer requiereNumOperacion;

    public TipoPagoEntity() {
    }

    public TipoPagoEntity(String descripcion, Integer activo, Integer requiereEfectivo, Integer requiereNumOperacion) {
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
