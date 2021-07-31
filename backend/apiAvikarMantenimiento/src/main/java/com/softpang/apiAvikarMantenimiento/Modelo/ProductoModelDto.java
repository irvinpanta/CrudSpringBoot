package com.softpang.apiAvikarMantenimiento.Modelo;

import com.softpang.apiAvikarMantenimiento.Entity.FamProductoEntity;
import com.softpang.apiAvikarMantenimiento.Entity.TipoProductoEntity;

public class ProductoModelDto {

    private Integer producto;
    private String descripcion;
    private Integer stock;
    private Double precio;
    private Integer activo;

    private FamProductoEntity famproducto;
    private TipoProductoEntity tipoProducto;

    public ProductoModelDto() {
    }

    public ProductoModelDto(String descripcion, Integer stock, Double precio, Integer activo, FamProductoEntity famproducto, TipoProductoEntity tipoProducto) {
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
}
