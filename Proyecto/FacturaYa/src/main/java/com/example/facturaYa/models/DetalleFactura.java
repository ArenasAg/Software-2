package com.example.facturaYa.models;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import jakarta.persistence.Column;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.JoinColumn;
import java.math.BigDecimal;

@Entity
@Table(name = "detalle_facturas")
public class DetalleFactura {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @Column(nullable = false)
    private Integer cantidad;

    @Column(nullable = false, precision = 8, scale = 2)
    private BigDecimal precioUnitario;

    @Column(nullable = false, precision = 8, scale = 2)
    private BigDecimal valorTotal;

    @Column(nullable = false, precision = 5, scale = 2)
    private BigDecimal descuento;

    @ManyToOne
    @JoinColumn(name = "producto_id", nullable = false)
    private Producto producto;

    @ManyToOne
    @JoinColumn(name = "factura_id", nullable = false)
    private Factura factura;

    public DetalleFactura() {}

    public DetalleFactura(Integer cantidad, BigDecimal precioUnitario, BigDecimal valorTotal, BigDecimal descuento, Producto producto, Factura factura) {
        this.cantidad = cantidad;
        this.precioUnitario = precioUnitario;
        this.valorTotal = valorTotal;
        this.descuento = descuento;
        this.producto = producto;
        this.factura = factura;
    }

    // Getters y Setters
    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public Integer getCantidad() {
        return cantidad;
    }

    public void setCantidad(Integer cantidad) {
        this.cantidad = cantidad;
    }

    public BigDecimal getPrecioUnitario() {
        return precioUnitario;
    }

    public void setPrecioUnitario(BigDecimal precioUnitario) {
        this.precioUnitario = precioUnitario;
    }

    public BigDecimal getValorTotal() {
        return valorTotal;
    }

    public void setValorTotal(BigDecimal valorTotal) {
        this.valorTotal = valorTotal;
    }

    public BigDecimal getDescuento() {
        return descuento;
    }

    public void setDescuento(BigDecimal descuento) {
        this.descuento = descuento;
    }

    public Producto getProducto() {
        return producto;
    }

    public void setProducto(Producto producto) {
        this.producto = producto;
    }

    public Factura getFactura() {
        return factura;
    }

    public void setFactura(Factura factura) {
        this.factura = factura;
    }

    // Principio DRY: Los cálculos de descuentos o impuestos se manejarán en un servicio reutilizable.
}
