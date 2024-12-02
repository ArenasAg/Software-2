package com.example.facturaYa.services;

import com.example.facturaYa.models.Impuesto;
import com.example.facturaYa.repositories.ImpuestoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import java.math.BigDecimal;
import java.util.List;


@Service
public class ImpuestoService implements IImpuestoService {

    private final ImpuestoRepository impuestoRepository;

    @Autowired
    public ImpuestoService(ImpuestoRepository impuestoRepository) {
        this.impuestoRepository = impuestoRepository;
    }

    @Override
    @Transactional
    public Impuesto crearImpuesto(String nombre, BigDecimal porcentaje) {
        Impuesto impuesto = new Impuesto(nombre, porcentaje);
        return impuestoRepository.save(impuesto);
    }

    @Override
    public Impuesto obtenerImpuesto(Long id) {
        return impuestoRepository.findById(id).orElseThrow(() -> new RuntimeException("Impuesto no encontrado"));
    }

    @Override
    public List<Impuesto> obtenerTodosLosImpuestos() {
        return impuestoRepository.findAll();
    }

    @Override
    @Transactional
    public Impuesto actualizarImpuesto(Long id, String nuevoNombre, BigDecimal nuevoPorcentaje) {
        Impuesto impuesto = obtenerImpuesto(id);
        impuesto.setNombre(nuevoNombre);
        impuesto.setPorcentaje(nuevoPorcentaje);
        return impuestoRepository.save(impuesto);
    }

    @Override
    @Transactional
    public void eliminarImpuesto(Long id) {
        Impuesto impuesto = obtenerImpuesto(id);
        impuestoRepository.delete(impuesto);
    }
}