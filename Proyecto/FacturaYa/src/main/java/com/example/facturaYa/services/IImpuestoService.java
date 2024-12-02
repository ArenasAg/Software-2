package com.example.facturaYa.services;

import java.math.BigDecimal;
import java.util.List;

import com.example.facturaYa.models.Impuesto;

public interface IImpuestoService {
    Impuesto crearImpuesto(String nombre, BigDecimal porcentaje);
    Impuesto obtenerImpuesto(Long id);
    List<Impuesto> obtenerTodosLosImpuestos();
    Impuesto actualizarImpuesto(Long id, String nuevoNombre, BigDecimal nuevoPorcentaje);
    void eliminarImpuesto(Long id);
}
