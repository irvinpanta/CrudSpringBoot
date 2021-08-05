package com.softpang.apiAvikarConfig.Entity;

import lombok.Data;
import lombok.NoArgsConstructor;

import javax.persistence.*;

@Entity
@Table(name = "roles")
@Data @NoArgsConstructor
public class RolEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer rol;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 1)
    private Integer orden;

    @Column(length = 1)
    private Integer activo;


    public RolEntity(String descripcion, Integer orden, Integer activo) {
        this.descripcion = descripcion;
        this.orden = orden;
        this.activo = activo;
    }

}
