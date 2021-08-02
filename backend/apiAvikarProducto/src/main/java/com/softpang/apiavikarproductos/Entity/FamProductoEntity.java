package com.softpang.apiavikarproductos.Entity;

import javax.persistence.*;
import java.util.Date;

@Entity
@Table(name="famproducto")
public class FamProductoEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 1)
    private Integer activo;

    @Temporal(TemporalType.DATE)
    private Date fechaSistema;

    public FamProductoEntity() {
    }

    public FamProductoEntity(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
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
