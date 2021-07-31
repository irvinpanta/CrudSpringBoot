package com.softpang.apiAvikarMantenimiento.Entity;

import javax.persistence.*;
import javax.validation.constraints.*;
import java.util.Date;

@Entity
@Table(name="productos")
public class ProductoEntity {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer producto;

    @Column(length = 50, unique = true, nullable = false)
    private String descripcion;

    @Min(value = 1)
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

    public ProductoEntity() {
    }

    public ProductoEntity(String descripcion, Integer stock, Double precio, Integer activo, FamProductoEntity famproducto, TipoProductoEntity tipoProducto) {
        this.descripcion = descripcion;
        this.stock = stock;
        this.precio = precio;
        this.activo = activo;
        this.famproducto = famproducto;
        this.tipoProducto = tipoProducto;
    }

    public Integer getProducto() {
        return producto;
    }

    public void setProducto(Integer producto) {
        this.producto = producto;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Integer getStock() {
        return stock;
    }

    public void setStock(Integer stock) {
        this.stock = stock;
    }

    public Double getPrecio() {
        return precio;
    }

    public void setPrecio(Double precio) {
        this.precio = precio;
    }

    public Integer getActivo() {
        return activo;
    }

    public void setActivo(Integer activo) {
        this.activo = activo;
    }

    public FamProductoEntity getFamproducto() {
        return famproducto;
    }

    public void setFamproducto(FamProductoEntity famproducto) {
        this.famproducto = famproducto;
    }

    public TipoProductoEntity getTipoProducto() {
        return tipoProducto;
    }

    public void setTipoProducto(TipoProductoEntity tipoProducto) {
        this.tipoProducto = tipoProducto;
    }

    public Date getFecSistema() {
        return fecSistema;
    }

    @PrePersist
    public void setFecSistema() {
        this.fecSistema = new Date();
    }
}
