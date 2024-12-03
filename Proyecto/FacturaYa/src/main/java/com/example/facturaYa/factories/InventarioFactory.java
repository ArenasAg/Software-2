package com.example.facturaYa.factories;

import java.time.LocalDateTime;

import com.example.facturaYa.models.Inventario; // Add this import statement

public class InventarioFactory {
    public static Inventario crearInventario(LocalDateTime fecha, String tipoMovimiento) {
        return new Inventario(fecha, tipoMovimiento);
    }
}
