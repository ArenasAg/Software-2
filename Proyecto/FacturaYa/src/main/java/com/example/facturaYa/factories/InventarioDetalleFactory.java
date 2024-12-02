package com.example.facturaYa.factories;

import com.example.facturaYa.models.Inventario;
import com.example.facturaYa.models.Producto;
import com.example.facturaYa.models.InventarioDetalle;

public class InventarioDetalleFactory {
    public static InventarioDetalle crearInventarioDetalle(Inventario inventario, Producto producto, Integer cantidad) {
        return new InventarioDetalle(inventario, producto, cantidad);
    }
}
