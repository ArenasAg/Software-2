package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.InventarioDetalle;
import com.example.facturaYa.services.InventarioDetalleService;
import java.util.List;

@RestController
@RequestMapping("api/inventario-detalles")
public class InventarioDetalleController {

    private final InventarioDetalleService inventarioDetalleService;

    @Autowired
    public InventarioDetalleController(InventarioDetalleService inventarioDetalleService) {
        this.inventarioDetalleService = inventarioDetalleService;
    }

    // Crear un nuevo detalle de inventario
    @PostMapping
    public ResponseEntity<InventarioDetalle> crearInventarioDetalle(@RequestBody InventarioDetalle inventarioDetalle) {
        InventarioDetalle inventarioDetalleCreado = inventarioDetalleService.crearInventarioDetalle(inventarioDetalle.getInventario(), inventarioDetalle.getProducto(), inventarioDetalle.getCantidad());
        return ResponseEntity.status(HttpStatus.CREATED).body(inventarioDetalleCreado);
    }

    // Obtener un detalle de inventario por ID
    @GetMapping("/{id}")
    public ResponseEntity<InventarioDetalle> obtenerInventarioDetalle(@PathVariable Long id) {
        InventarioDetalle inventarioDetalle = inventarioDetalleService.obtenerInventarioDetalle(id);
        return ResponseEntity.ok(inventarioDetalle);
    }

    // Obtener todos los detalles de inventario
    @GetMapping
    public ResponseEntity<List<InventarioDetalle>> obtenerTodosLosInventarioDetalles() {
        List<InventarioDetalle> inventarioDetalles = inventarioDetalleService.obtenerTodosLosInventarioDetalles();
        return ResponseEntity.ok(inventarioDetalles);
    }

    // Actualizar un detalle de inventario
    @PutMapping("/{id}")
    public ResponseEntity<InventarioDetalle> actualizarInventarioDetalle(@PathVariable Long id, @RequestBody InventarioDetalle inventarioDetalle) {
        InventarioDetalle inventarioDetalleActualizado = inventarioDetalleService.actualizarInventarioDetalle(id, inventarioDetalle.getInventario(), inventarioDetalle.getProducto(), inventarioDetalle.getCantidad());
        return ResponseEntity.ok(inventarioDetalleActualizado);
    }

    // Eliminar un detalle de inventario
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarInventarioDetalle(@PathVariable Long id) {
        inventarioDetalleService.eliminarInventarioDetalle(id);
        return ResponseEntity.noContent().build();
    }
}