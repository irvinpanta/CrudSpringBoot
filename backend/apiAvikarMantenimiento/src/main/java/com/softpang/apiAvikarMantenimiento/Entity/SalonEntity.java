package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;

@Entity
@Table(name = "salones")
public class SalonEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long salon;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    private Integer capacidad;

    @Column(length = 1)
    private Integer activo;

    public SalonEntity() {
    }

    public SalonEntity(String descripcion, Integer capacidad, Integer activo) {
        this.descripcion = descripcion;
        this.capacidad = capacidad;
        this.activo = activo;
    }

    public Long getSalon() {
        return salon;
    }

    public void setSalon(Long salon) {
        this.salon = salon;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getCapacidad() {
        return capacidad;
    }

    public void setCapacidad(Integer capacidad) {
        this.capacidad = capacidad;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }
}
