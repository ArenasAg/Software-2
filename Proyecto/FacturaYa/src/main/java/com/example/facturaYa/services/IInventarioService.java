package com.example.facturaYa.services;

import java.time.LocalDate;
import java.util.List;

import com.example.facturaYa.models.Inventario;

public interface IInventarioService {
    Inventario crearInventario(LocalDate fecha, String tipoMovimiento);
    Inventario obtenerInventario(Long id);
    List<Inventario> obtenerTodosLosInventarios();
    Inventario actualizarInventario(Long id, LocalDate nuevaFecha, String nuevoTipoMovimiento);
    void eliminarInventario(Long id);
}