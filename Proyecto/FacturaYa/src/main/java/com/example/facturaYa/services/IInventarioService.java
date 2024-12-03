package com.example.facturaYa.services;

import java.time.LocalDateTime;
import java.util.List;

import com.example.facturaYa.models.Inventario;

public interface IInventarioService {
    Inventario crearInventario(LocalDateTime fecha, String tipoMovimiento);
    Inventario obtenerInventario(Long id);
    List<Inventario> obtenerTodosLosInventarios();
    Inventario actualizarInventario(Long id, LocalDateTime nuevaFecha, String nuevoTipoMovimiento);
    void eliminarInventario(Long id);
}