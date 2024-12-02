package com.example.facturaYa.services;

import java.util.List;

import com.example.facturaYa.models.MetodoPago;

public interface IMetodoPagoService {
    MetodoPago crearMetodoPago(String nombre, String identificador);
    MetodoPago obtenerMetodoPago(Long id);
    List<MetodoPago> obtenerTodosLosMetodosPago();
    MetodoPago actualizarMetodoPago(Long id, String nuevoNombre, String nuevoIdentificador);
    void eliminarMetodoPago(Long id);
    
}
