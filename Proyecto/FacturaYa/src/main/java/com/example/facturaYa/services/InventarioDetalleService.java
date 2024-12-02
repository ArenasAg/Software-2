package com.example.facturaYa.services;

import com.example.facturaYa.models.Inventario;
import com.example.facturaYa.models.Producto;
import com.example.facturaYa.repositories.InventarioDetalleRepository;
import com.example.facturaYa.models.InventarioDetalle;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

@Service
public class InventarioDetalleService implements IInventarioDetalleService {

    private final InventarioDetalleRepository inventarioDetalleRepository;

    @Autowired
    public InventarioDetalleService(InventarioDetalleRepository inventarioDetalleRepository) {
        this.inventarioDetalleRepository = inventarioDetalleRepository;
    }

    @Override
    @Transactional
    public InventarioDetalle crearInventarioDetalle(Inventario inventario, Producto producto, Integer cantidad) {
        InventarioDetalle inventarioDetalle = new InventarioDetalle(inventario, producto, cantidad);
        return inventarioDetalleRepository.save(inventarioDetalle);
    }

    @Override
    public InventarioDetalle obtenerInventarioDetalle(Long id) {
        return inventarioDetalleRepository.findById(id).orElseThrow(() -> new RuntimeException("InventarioDetalle no encontrado"));
    }

    @Override
    public List<InventarioDetalle> obtenerTodosLosInventarioDetalles() {
        return inventarioDetalleRepository.findAll();
    }

    @Override
    @Transactional
    public InventarioDetalle actualizarInventarioDetalle(Long id, Inventario nuevoInventario, Producto nuevoProducto, Integer nuevaCantidad) {
        InventarioDetalle inventarioDetalle = obtenerInventarioDetalle(id);
        inventarioDetalle.setInventario(nuevoInventario);
        inventarioDetalle.setProducto(nuevoProducto);
        inventarioDetalle.setCantidad(nuevaCantidad);
        return inventarioDetalleRepository.save(inventarioDetalle);
    }

    @Override
    @Transactional
    public void eliminarInventarioDetalle(Long id) {
        InventarioDetalle inventarioDetalle = obtenerInventarioDetalle(id);
        inventarioDetalleRepository.delete(inventarioDetalle);
    }
}