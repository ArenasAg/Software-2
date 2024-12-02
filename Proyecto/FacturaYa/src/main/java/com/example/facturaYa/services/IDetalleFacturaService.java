package com.example.facturaYa.services;

import java.math.BigDecimal;
import java.util.List;

import com.example.facturaYa.models.DetalleFactura;
import com.example.facturaYa.models.Factura;
import com.example.facturaYa.models.Producto;

public interface IDetalleFacturaService {
    DetalleFactura crearDetalleFactura(Integer cantidad, BigDecimal precioUnitario, BigDecimal valorTotal, BigDecimal descuento, Producto producto, Factura factura);
    DetalleFactura obtenerDetalleFactura(Long id);
    List<DetalleFactura> obtenerTodosLosDetallesFactura();
    DetalleFactura actualizarDetalleFactura(Long id, Integer nuevaCantidad, BigDecimal nuevoPrecioUnitario, BigDecimal nuevoValorTotal, BigDecimal nuevoDescuento, Producto nuevoProducto, Factura nuevaFactura);
    void eliminarDetalleFactura(Long id);
}
