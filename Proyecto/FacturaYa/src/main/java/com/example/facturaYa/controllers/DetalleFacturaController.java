package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.DetalleFactura;
import com.example.facturaYa.services.DetalleFacturaService;

import java.util.List;

@RestController
@RequestMapping("api/detalles-factura")
public class DetalleFacturaController {

    private final DetalleFacturaService detalleFacturaService;

    @Autowired
    public DetalleFacturaController(DetalleFacturaService detalleFacturaService) {
        this.detalleFacturaService = detalleFacturaService;
    }

    // Crear un nuevo detalle de factura
    @PostMapping
    public ResponseEntity<DetalleFactura> crearDetalleFactura(@RequestBody DetalleFactura detalleFactura) {
        DetalleFactura detalleFacturaCreado = detalleFacturaService.crearDetalleFactura(detalleFactura.getCantidad(), detalleFactura.getPrecioUnitario(), detalleFactura.getValorTotal(), detalleFactura.getDescuento(), detalleFactura.getProducto(), detalleFactura.getFactura());
        return ResponseEntity.status(HttpStatus.CREATED).body(detalleFacturaCreado);
    }

    // Obtener un detalle de factura por ID
    @GetMapping("/{id}")
    public ResponseEntity<DetalleFactura> obtenerDetalleFactura(@PathVariable Long id) {
        DetalleFactura detalleFactura = detalleFacturaService.obtenerDetalleFactura(id);
        return ResponseEntity.ok(detalleFactura);
    }

    // Obtener todos los detalles de factura
    @GetMapping
    public ResponseEntity<List<DetalleFactura>> obtenerTodosLosDetallesFactura() {
        List<DetalleFactura> detallesFactura = detalleFacturaService.obtenerTodosLosDetallesFactura();
        return ResponseEntity.ok(detallesFactura);
    }

    // Actualizar un detalle de factura
    @PutMapping("/{id}")
    public ResponseEntity<DetalleFactura> actualizarDetalleFactura(@PathVariable Long id, @RequestBody DetalleFactura detalleFactura) {
        DetalleFactura detalleFacturaActualizado = detalleFacturaService.actualizarDetalleFactura(id, detalleFactura.getCantidad(), detalleFactura.getPrecioUnitario(), detalleFactura.getValorTotal(), detalleFactura.getDescuento(), detalleFactura.getProducto(), detalleFactura.getFactura());
        return ResponseEntity.ok(detalleFacturaActualizado);
    }

    // Eliminar un detalle de factura
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarDetalleFactura(@PathVariable Long id) {
        detalleFacturaService.eliminarDetalleFactura(id);
        return ResponseEntity.noContent().build();
    }
}