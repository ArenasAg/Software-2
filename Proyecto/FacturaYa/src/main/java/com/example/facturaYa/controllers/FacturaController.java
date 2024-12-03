package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import com.example.facturaYa.models.DetalleFactura;
import com.example.facturaYa.models.Factura;
import com.example.facturaYa.services.FacturaService;
import com.example.facturaYa.services.DetalleFacturaService;
import java.util.List;

@RestController
@RequestMapping("api/facturas")
public class FacturaController {
    private final FacturaService facturaService;
    private final DetalleFacturaService detalleFacturaService;
    @Autowired
    public FacturaController(FacturaService facturaService, DetalleFacturaService detalleFacturaService) {
        this.facturaService = facturaService;
        this.detalleFacturaService = detalleFacturaService;
    }

    // Crear una nueva factura
    @PostMapping
    public ResponseEntity<Factura> crearFactura(@RequestBody Factura factura) {
        Factura facturaCreada = facturaService.crearFactura(factura.getCodigo(), factura.getSubtotal(), factura.getTotalImpuestos(), factura.getTotal(), factura.getEstado(), factura.getCliente(), factura.getMetodoPago());
        return ResponseEntity.status(HttpStatus.CREATED).body(facturaCreada);
    }

    // Obtener una factura por ID
    @GetMapping("/{id}")
    public ResponseEntity<Factura> obtenerFactura(@PathVariable Long id) {
        Factura factura = facturaService.obtenerFactura(id);
        return ResponseEntity.ok(factura);
    }

    // Obtener todas las facturas
    @GetMapping
    public ResponseEntity<List<Factura>> obtenerTodasLasFacturas() {
        List<Factura> facturas = facturaService.obtenerTodasLasFacturas();
        return ResponseEntity.ok(facturas);
    }

    // Actualizar una factura
    @PutMapping("/{id}")
    public ResponseEntity<Factura> actualizarFactura(@PathVariable Long id, @RequestBody Factura factura) {
        Factura facturaActualizada = facturaService.actualizarFactura(id, factura.getCodigo(), factura.getFecha(), factura.getSubtotal(), factura.getTotalImpuestos(), factura.getTotal(), factura.getEstado(), factura.getCliente(), factura.getMetodoPago());
        return ResponseEntity.ok(facturaActualizada);
    }

    // Eliminar una factura
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarFactura(@PathVariable Long id) {
        facturaService.eliminarFactura(id);
        return ResponseEntity.noContent().build();
    }

    @GetMapping("/{id}/detalles")
    public ResponseEntity<DetalleFactura> getDetalleFacturaByFacturaid(@PathVariable Long id) {
        DetalleFactura detalleFactura = detalleFacturaService.getDetalleFacturaByFacturaId(id);
        return ResponseEntity.ok(detalleFactura);
    }
}
