package com.softpang.apiavikarproductos.Entity;

import lombok.Data;
import lombok.NoArgsConstructor;

import javax.persistence.*;

@Entity
@Table(name = "areadespacho")
@Data @NoArgsConstructor
public class AreaDespachoEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer despacho;

    @ManyToOne
    @JoinColumn(name = "producto")
    private ProductoEntity producto;

    @ManyToOne
    @JoinColumn(name = "area")
    private AreaEntity area;

    public AreaDespachoEntity(ProductoEntity producto, AreaEntity area) {
        this.producto = producto;
        this.area = area;
    }
}
