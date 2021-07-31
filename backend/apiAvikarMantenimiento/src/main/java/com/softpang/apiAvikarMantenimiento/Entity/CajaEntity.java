package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;
import java.util.Date;

@Entity
@Table(name = "cajas")
public class CajaEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long caja;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 1)
    private Integer activo;

    @Temporal(TemporalType.DATE)
    private Date fechaSistema;

    public CajaEntity() {
    }

    public CajaEntity(String descripcion, Integer activo) {
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

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
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
}
