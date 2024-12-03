package com.example.facturaYa.services;

import com.example.facturaYa.models.Cliente;
import com.example.facturaYa.models.Factura;
import com.example.facturaYa.models.MetodoPago;
import com.example.facturaYa.repositories.FacturaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import java.time.LocalDateTime;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.math.BigDecimal;
import java.util.List;

@Service
public class FacturaService implements IFacturaService {

    private final FacturaRepository facturaRepository;

    @Autowired
    public FacturaService(FacturaRepository facturaRepository) {
        this.facturaRepository = facturaRepository;
    }

    // Crear factura
    @Override
    @Transactional
    public Factura crearFactura(String codigo, BigDecimal subtotal, BigDecimal totalImpuestos, BigDecimal total, Boolean estado, Cliente cliente, MetodoPago metodoPago) {
        LocalDateTime fecha = LocalDateTime.now();
        Factura factura = new Factura(codigo, fecha, subtotal, totalImpuestos, total, estado, cliente, metodoPago);
        return facturaRepository.save(factura);
    }

    // Obtener factura por ID
    @Override
    public Factura obtenerFactura(Long id) {
        return facturaRepository.findById(id).orElseThrow(() -> new RuntimeException("Factura no encontrada"));
    }

    // Obtener todas las facturas
    @Override
    public List<Factura> obtenerTodasLasFacturas() {
        return facturaRepository.findAll();
    }

    // Actualizar factura
    @Override
    @Transactional
    public Factura actualizarFactura(Long id, String nuevoCodigo, LocalDateTime nuevaFecha, BigDecimal nuevoSubtotal, BigDecimal nuevoTotalImpuestos, BigDecimal nuevoTotal, Boolean nuevoEstado, Cliente nuevoCliente, MetodoPago nuevoMetodoPago) {
        Factura factura = obtenerFactura(id);
        factura.setCodigo(nuevoCodigo);
        factura.setFecha(nuevaFecha);
        factura.setSubtotal(nuevoSubtotal);
        factura.setTotalImpuestos(nuevoTotalImpuestos);
        factura.setTotal(nuevoTotal);
        factura.setEstado(nuevoEstado);
        factura.setCliente(nuevoCliente);
        factura.setMetodoPago(nuevoMetodoPago);
        return facturaRepository.save(factura);
    }

    // Eliminar factura
    @Override
    @Transactional
    public void eliminarFactura(Long id) {
        Factura factura = obtenerFactura(id);
        facturaRepository.delete(factura);
    }

    
}