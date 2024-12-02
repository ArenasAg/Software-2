package com.example.facturaYa.services;

import java.math.BigDecimal;
import java.util.List;

import com.example.facturaYa.models.Cliente;
import com.example.facturaYa.models.Factura;
import com.example.facturaYa.models.MetodoPago;

public interface IFacturaService {
    Factura crearFactura(String codigo, BigDecimal subtotal, BigDecimal totalImpuestos, BigDecimal total, Boolean estado, Cliente cliente, MetodoPago metodoPago);
    Factura obtenerFactura(Long id);
    List<Factura> obtenerTodasLasFacturas();
    Factura actualizarFactura(Long id, String nuevoCodigo, BigDecimal nuevoSubtotal, BigDecimal nuevoTotalImpuestos, BigDecimal nuevoTotal, Boolean nuevoEstado, Cliente nuevoCliente, MetodoPago nuevoMetodoPago);
    void eliminarFactura(Long id);

}
