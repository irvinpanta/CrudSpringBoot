package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;
import java.util.Date;

@Entity
@Table(name = "tipooperacion")
public class TipoOperacionEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long tipoOperacion;

    @Column(length = 50, nullable = false, unique = true)
    private String descripcion;

    @Column(length = 1)
    private Integer activo;

    @Temporal(TemporalType.DATE)
    private Date fechaSistema;

    public TipoOperacionEntity() {
    }

    public TipoOperacionEntity(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
        this.fechaSistema = fechaSistema;
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

    public Date getFechaSistema() {
        return fechaSistema;
    }

    @PrePersist
    public void setFechaSistema() {
        this.fechaSistema = new Date();
    }
}
