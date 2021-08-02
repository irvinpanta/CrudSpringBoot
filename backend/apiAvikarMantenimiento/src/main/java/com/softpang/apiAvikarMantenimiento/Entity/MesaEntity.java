package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;
import java.util.Date;

@Entity
@Table(name = "mesas")
public class MesaEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer mesa;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 2)
    private Integer cantidad;

    @Column(length = 1)
    private Integer activo;

    @Temporal(TemporalType.DATE)
    private Date fechaSistema;

    @Column(length = 1)
    private Integer mesarapida;

    @ManyToOne
    @JoinColumn(name = "salon", nullable = false)
    private SalonEntity salon;

    public MesaEntity() {
    }

    public MesaEntity(String descripcion, Integer cantidad, Integer activo, Integer mesarapida, SalonEntity salon) {
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

    public Date getFechaSistema() {
        return fechaSistema;
    }

    @PrePersist
    public void setFechaSistema() {
        this.fechaSistema = new Date();
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
