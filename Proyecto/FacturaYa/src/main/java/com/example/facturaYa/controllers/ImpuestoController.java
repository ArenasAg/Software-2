package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.Impuesto;
import com.example.facturaYa.services.ImpuestoService;
import java.util.List;

@RestController
@RequestMapping("api/impuestos")
public class ImpuestoController {

    private final ImpuestoService impuestoService;

    @Autowired
    public ImpuestoController(ImpuestoService impuestoService) {
        this.impuestoService = impuestoService;
    }

    // Crear un nuevo impuesto
    @PostMapping
    public ResponseEntity<Impuesto> crearImpuesto(@RequestBody Impuesto impuesto) {
        Impuesto impuestoCreado = impuestoService.crearImpuesto(impuesto.getNombre(), impuesto.getPorcentaje());
        return ResponseEntity.status(HttpStatus.CREATED).body(impuestoCreado);
    }

    // Obtener un impuesto por ID
    @GetMapping("/{id}")
    public ResponseEntity<Impuesto> obtenerImpuesto(@PathVariable Long id) {
        Impuesto impuesto = impuestoService.obtenerImpuesto(id);
        return ResponseEntity.ok(impuesto);
    }

    // Obtener todos los impuestos
    @GetMapping
    public ResponseEntity<List<Impuesto>> obtenerTodosLosImpuestos() {
        List<Impuesto> impuestos = impuestoService.obtenerTodosLosImpuestos();
        return ResponseEntity.ok(impuestos);
    }

    // Actualizar un impuesto
    @PutMapping("/{id}")
    public ResponseEntity<Impuesto> actualizarImpuesto(@PathVariable Long id, @RequestBody Impuesto impuesto) {
        Impuesto impuestoActualizado = impuestoService.actualizarImpuesto(id, impuesto.getNombre(), impuesto.getPorcentaje());
        return ResponseEntity.ok(impuestoActualizado);
    }

    // Eliminar un impuesto
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarImpuesto(@PathVariable Long id) {
        impuestoService.eliminarImpuesto(id);
        return ResponseEntity.noContent().build();
    }
}