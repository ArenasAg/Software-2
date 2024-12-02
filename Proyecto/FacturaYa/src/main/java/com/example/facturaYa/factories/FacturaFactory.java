package com.example.facturaYa.factories;

import com.example.facturaYa.models.Cliente;
import com.example.facturaYa.models.Factura;
import com.example.facturaYa.models.MetodoPago;
import java.math.BigDecimal;

public class FacturaFactory {

    public static Factura crearFactura(String codigo, BigDecimal subtotal, BigDecimal totalImpuestos, BigDecimal total, Boolean estado, Cliente cliente, MetodoPago metodoPago) {
        return new Factura(codigo, subtotal, totalImpuestos, total, estado, cliente, metodoPago);
    }
}