package com.example.facturaYa.factories;

import com.example.facturaYa.models.MetodoPago;

public class MetodoPagoFactory {
    public static MetodoPago crearMetodoPago(String nombre, String identificador) {
        return new MetodoPago(nombre, identificador);
    }
}
