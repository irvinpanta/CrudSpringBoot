package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;
import java.util.Date;

@Entity
@Table(name = "tipoproducto")
public class TipoProductoEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long tipoProducto;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 1)
    private Integer activo;

    @Temporal(TemporalType.DATE)
    private Date fechaSistema;

    public TipoProductoEntity() {
    }

    public TipoProductoEntity(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }

    public Long getTipoProducto() {
        return tipoProducto;
    }

    public void setTipoProducto(Long tipoProducto) {
        this.tipoProducto = tipoProducto;
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
