package com.softpang.apiavikarproductos.Entity;

import lombok.Data;
import lombok.NoArgsConstructor;

import javax.persistence.*;
import java.util.Date;

@Entity
@Table(name="productos")
@Data @NoArgsConstructor
public class ProductoEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer producto;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    private Integer stock;

    @Column(precision = 2)
    private Double precio;

    @Column(length = 1)
    private Integer activo;

    @ManyToOne
    @JoinColumn(name = "famproducto", nullable = false)
    private FamProductoEntity famproducto;

    @ManyToOne
    @JoinColumn(name = "tipoproducto", nullable = false)
    private TipoProductoEntity tipoProducto;

    @Temporal(TemporalType.DATE)
    private Date fecSistema;

    public ProductoEntity(String descripcion, Integer stock, Double precio, Integer activo, FamProductoEntity famproducto, TipoProductoEntity tipoProducto) {
        this.descripcion = descripcion;
        this.stock = stock;
        this.precio = precio;
        this.activo = activo;
        this.famproducto = famproducto;
        this.tipoProducto = tipoProducto;
    }

    @PrePersist
    public void setFecSistema() {
        this.fecSistema = new Date();
    }
}
