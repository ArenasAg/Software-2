package com.example.facturaYa.factories;

import java.math.BigDecimal;

import com.example.facturaYa.models.Impuesto;

public class ImpuestoFactory {

    public static Impuesto crearImpuestoService(String nombre, BigDecimal porcentaje) {
        return new Impuesto(nombre, porcentaje);
    }
}