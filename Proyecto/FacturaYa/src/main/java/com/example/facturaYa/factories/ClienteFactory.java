package com.example.facturaYa.factories;

import com.example.facturaYa.models.Cliente;

public class ClienteFactory {
    public static Cliente crearCliente(String numero_documento, String nombre, String direccion, String email, String telefono, String ciudad) {
        return new Cliente(numero_documento, nombre, direccion, email, telefono, ciudad);
    }
}