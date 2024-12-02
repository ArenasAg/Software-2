package com.example.facturaYa.services;

import com.example.facturaYa.models.Cliente;

import java.util.List;

public interface IClienteService {
    Cliente crearCliente(String numero_documento, String nombre, String direccion, String email, String telefono, String ciudad);
    Cliente obtenerCliente(Long id);
    List<Cliente> obtenerTodosLosClientes();
    Cliente actualizarCliente(Long id, String nuevoNumero_documento, String nuevoNombre, String nuevaDireccion, String nuevoEmail, String nuevoTelefono, String nuevaCiudad);
    void eliminarCliente(Long id);
}
