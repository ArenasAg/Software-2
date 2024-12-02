package com.example.facturaYa.services;

import com.example.facturaYa.models.DetalleFactura;
import com.example.facturaYa.models.Producto;
import com.example.facturaYa.models.Factura;
import com.example.facturaYa.repositories.DetalleFacturaRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import java.math.BigDecimal;
import java.util.List;

@Service
public class DetalleFacturaService implements IDetalleFacturaService {

    private final DetalleFacturaRepository detalleFacturaRepository;

    @Autowired
    public DetalleFacturaService(DetalleFacturaRepository detalleFacturaRepository) {
        this.detalleFacturaRepository = detalleFacturaRepository;
    }

    // Crear detalle de factura
    @Override
    @Transactional
    public DetalleFactura crearDetalleFactura(Integer cantidad, BigDecimal precioUnitario, BigDecimal valorTotal, BigDecimal descuento, Producto producto, Factura factura) {
        DetalleFactura detalleFactura = new DetalleFactura(cantidad, precioUnitario, valorTotal, descuento, producto, factura);
        return detalleFacturaRepository.save(detalleFactura);
    }

    // Obtener detalle de factura por ID
    @Override
    public DetalleFactura obtenerDetalleFactura(Long id) {
        return detalleFacturaRepository.findById(id).orElseThrow(() -> new RuntimeException("Detalle de factura no encontrado"));
    }

    // Obtener todos los detalles de factura
    @Override
    public List<DetalleFactura> obtenerTodosLosDetallesFactura() {
        return detalleFacturaRepository.findAll();
    }

    // Actualizar detalle de factura
    @Override
    @Transactional
    public DetalleFactura actualizarDetalleFactura(Long id, Integer nuevaCantidad, BigDecimal nuevoPrecioUnitario, BigDecimal nuevoValorTotal, BigDecimal nuevoDescuento, Producto nuevoProducto, Factura nuevaFactura) {
        DetalleFactura detalleFactura = obtenerDetalleFactura(id);
        detalleFactura.setCantidad(nuevaCantidad);
        detalleFactura.setPrecioUnitario(nuevoPrecioUnitario);
        detalleFactura.setValorTotal(nuevoValorTotal);
        detalleFactura.setDescuento(nuevoDescuento);
        detalleFactura.setProducto(nuevoProducto);
        detalleFactura.setFactura(nuevaFactura);
        return detalleFacturaRepository.save(detalleFactura);
    }

    // Eliminar detalle de factura
    @Override
    @Transactional
    public void eliminarDetalleFactura(Long id) {
        DetalleFactura detalleFactura = obtenerDetalleFactura(id);
        detalleFacturaRepository.delete(detalleFactura);
    }

    public DetalleFactura getDetalleFacturaByFacturaId(Long facturaId) {
        return detalleFacturaRepository.findByFacturaId(facturaId);
    }
}
