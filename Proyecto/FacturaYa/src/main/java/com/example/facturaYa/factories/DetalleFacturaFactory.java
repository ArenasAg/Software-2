package com.example.facturaYa.factories;

import com.example.facturaYa.models.DetalleFactura;
import com.example.facturaYa.models.Producto;
import com.example.facturaYa.models.Factura;
import java.math.BigDecimal;

public class DetalleFacturaFactory {

    public static DetalleFactura crearDetalleFactura(Integer cantidad, BigDecimal precioUnitario, BigDecimal valorTotal, BigDecimal descuento, Producto producto, Factura factura) {
        return new DetalleFactura(cantidad, precioUnitario, valorTotal, descuento, producto, factura);
    }
}