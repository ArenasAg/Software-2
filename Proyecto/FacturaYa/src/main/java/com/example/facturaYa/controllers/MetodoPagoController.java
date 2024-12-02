package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.MetodoPago;
import com.example.facturaYa.services.MetodoPagoService;
import java.util.List;

@RestController
@RequestMapping("api/metodos-pago")
public class MetodoPagoController {

    private final MetodoPagoService metodoPagoService;

    @Autowired
    public MetodoPagoController(MetodoPagoService metodoPagoService) {
        this.metodoPagoService = metodoPagoService;
    }

    // Crear un nuevo método de pago
    @PostMapping
    public ResponseEntity<MetodoPago> crearMetodoPago(@RequestBody MetodoPago metodoPago) {
        MetodoPago metodoPagoCreado = metodoPagoService.crearMetodoPago(metodoPago.getNombre(), metodoPago.getIdentificador());
        return ResponseEntity.status(HttpStatus.CREATED).body(metodoPagoCreado);
    }

    // Obtener un método de pago por ID
    @GetMapping("/{id}")
    public ResponseEntity<MetodoPago> obtenerMetodoPago(@PathVariable Long id) {
        MetodoPago metodoPago = metodoPagoService.obtenerMetodoPago(id);
        return ResponseEntity.ok(metodoPago);
    }

    // Obtener todos los métodos de pago
    @GetMapping
    public ResponseEntity<List<MetodoPago>> obtenerTodosLosMetodosPago() {
        List<MetodoPago> metodosPago = metodoPagoService.obtenerTodosLosMetodosPago();
        return ResponseEntity.ok(metodosPago);
    }

    // Actualizar un método de pago
    @PutMapping("/{id}")
    public ResponseEntity<MetodoPago> actualizarMetodoPago(@PathVariable Long id, @RequestBody MetodoPago metodoPago) {
        MetodoPago metodoPagoActualizado = metodoPagoService.actualizarMetodoPago(id, metodoPago.getNombre(), metodoPago.getIdentificador());
        return ResponseEntity.ok(metodoPagoActualizado);
    }

    // Eliminar un método de pago
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarMetodoPago(@PathVariable Long id) {
        metodoPagoService.eliminarMetodoPago(id);
        return ResponseEntity.noContent().build();
    }
}
