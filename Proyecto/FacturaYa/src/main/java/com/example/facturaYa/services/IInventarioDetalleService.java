package com.example.facturaYa.services;

import java.util.List;

import com.example.facturaYa.models.Inventario;
import com.example.facturaYa.models.InventarioDetalle;
import com.example.facturaYa.models.Producto;

public interface IInventarioDetalleService {
    InventarioDetalle crearInventarioDetalle(Inventario inventario, Producto producto, Integer cantidad);
    InventarioDetalle obtenerInventarioDetalle(Long id);
    List<InventarioDetalle> obtenerTodosLosInventarioDetalles();
    InventarioDetalle actualizarInventarioDetalle(Long id, Inventario nuevoInventario, Producto nuevoProducto, Integer nuevaCantidad);
    void eliminarInventarioDetalle(Long id);
}
