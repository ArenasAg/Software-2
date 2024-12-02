package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.Inventario;
import com.example.facturaYa.services.InventarioService;
import java.util.List;

@RestController
@RequestMapping("api/inventarios")
public class InventarioController {

    private final InventarioService inventarioService;

    @Autowired
    public InventarioController(InventarioService inventarioService) {
        this.inventarioService = inventarioService;
    }

    // Crear un nuevo inventario
    @PostMapping
    public ResponseEntity<Inventario> crearInventario(@RequestBody Inventario inventario) {
        Inventario inventarioCreado = inventarioService.crearInventario(inventario.getFecha(), inventario.getTipoMovimiento());
        return ResponseEntity.status(HttpStatus.CREATED).body(inventarioCreado);
    }

    // Obtener un inventario por ID
    @GetMapping("/{id}")
    public ResponseEntity<Inventario> obtenerInventario(@PathVariable Long id) {
        Inventario inventario = inventarioService.obtenerInventario(id);
        return ResponseEntity.ok(inventario);
    }

    // Obtener todos los inventarios
    @GetMapping
    public ResponseEntity<List<Inventario>> obtenerTodosLosInventarios() {
        List<Inventario> inventarios = inventarioService.obtenerTodosLosInventarios();
        return ResponseEntity.ok(inventarios);
    }

    // Actualizar un inventario
    @PutMapping("/{id}")
    public ResponseEntity<Inventario> actualizarInventario(@PathVariable Long id, @RequestBody Inventario inventario) {
        Inventario inventarioActualizado = inventarioService.actualizarInventario(id, inventario.getFecha(), inventario.getTipoMovimiento());
        return ResponseEntity.ok(inventarioActualizado);
    }

    // Eliminar un inventario
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarInventario(@PathVariable Long id) {
        inventarioService.eliminarInventario(id);
        return ResponseEntity.noContent().build();
    }
}