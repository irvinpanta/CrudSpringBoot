package com.softpang.apiavikarproductos.Entity;

import lombok.Data;
import lombok.NoArgsConstructor;

import javax.persistence.*;

@Entity
@Table(name = "areas")
@Data @NoArgsConstructor
public class AreaEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer area;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Column(length = 1)
    private Integer activo;

    public AreaEntity(String descripcion, Integer activo) {
        this.descripcion = descripcion;
        this.activo = activo;
    }


}
