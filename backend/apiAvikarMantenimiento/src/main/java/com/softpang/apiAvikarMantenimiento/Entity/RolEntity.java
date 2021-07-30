package com.softpang.apiAvikarMantenimiento.Entity;

import lombok.Data;

import javax.persistence.*;

@Entity
@Table(name = "roles")
public class RolEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long rol;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 1)
    private Integer orden;

    @Column(length = 1)
    private Integer activo;

    public RolEntity() {
    }

    public RolEntity(String descripcion, Integer orden, Integer activo) {
        this.descripcion = descripcion;
        this.orden = orden;
        this.activo = activo;
    }

    public Long getRol() {
        return rol;
    }

    public void setRol(Long rol) {
        this.rol = rol;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getOrden() {
        return orden;
    }

    public void setOrden(Integer orden) {
        this.orden = orden;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }
}
