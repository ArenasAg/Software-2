package com.example.facturaYa.services;

import com.example.facturaYa.models.MetodoPago;
import com.example.facturaYa.repositories.MetodoPagoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import java.util.List;


@Service
public class MetodoPagoService implements IMetodoPagoService {

    private final MetodoPagoRepository metodoPagoRepository;

    @Autowired
    public MetodoPagoService(MetodoPagoRepository metodoPagoRepository) {
        this.metodoPagoRepository = metodoPagoRepository;
    }

    @Override
    @Transactional
    public MetodoPago crearMetodoPago(String nombre, String identificador) {
        MetodoPago metodoPago = new MetodoPago(nombre, identificador);
        return metodoPagoRepository.save(metodoPago);
    }

    @Override
    public MetodoPago obtenerMetodoPago(Long id) {
        return metodoPagoRepository.findById(id).orElseThrow(() -> new RuntimeException("Método de pago no encontrado"));
    }

    @Override
    public List<MetodoPago> obtenerTodosLosMetodosPago() {
        return metodoPagoRepository.findAll();
    }

    @Override
    @Transactional
    public MetodoPago actualizarMetodoPago(Long id, String nuevoNombre, String nuevaIdentificador) {
        MetodoPago metodoPago = obtenerMetodoPago(id);
        metodoPago.setNombre(nuevoNombre);
        metodoPago.setIdentificador(nuevaIdentificador);
        return metodoPagoRepository.save(metodoPago);
    }

    @Override
    @Transactional
    public void eliminarMetodoPago(Long id) {
        MetodoPago metodoPago = obtenerMetodoPago(id);
        metodoPagoRepository.delete(metodoPago);
    }
}