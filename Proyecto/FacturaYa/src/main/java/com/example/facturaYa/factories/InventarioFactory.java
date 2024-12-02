package com.example.facturaYa.factories;

import java.time.LocalDate;

import com.example.facturaYa.models.Inventario; // Add this import statement

public class InventarioFactory {
    public static Inventario crearInventario(LocalDate fecha, String tipoMovimiento) {
        return new Inventario(fecha, tipoMovimiento);
    }
}
