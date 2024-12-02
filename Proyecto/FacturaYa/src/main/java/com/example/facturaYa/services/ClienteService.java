package com.example.facturaYa.services;

import com.example.facturaYa.repositories.ClienteRepository;
import com.example.facturaYa.models.Cliente;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import java.util.List;

@Service
public class ClienteService implements IClienteService {

    private final ClienteRepository clienteRepository;

    @Autowired
    public ClienteService(ClienteRepository clienteRepository) {
        this.clienteRepository = clienteRepository;
    }

    // Crear cliente
    @Override
    @Transactional
    public Cliente crearCliente(String numero_documento, String nombre, String direccion, String email, String telefono, String ciudad) {
        Cliente cliente = new Cliente(numero_documento, nombre, direccion, email, telefono, ciudad);
        return clienteRepository.save(cliente);
    }

    // Obtener cliente por ID
    @Override
    public Cliente obtenerCliente(Long id) {
        return clienteRepository.findById(id).orElseThrow(() -> new RuntimeException("Cliente no encontrado"));
    }

    // Obtener todos los clientes
    @Override
    public List<Cliente> obtenerTodosLosClientes() {
        return clienteRepository.findAll();
    }

    // Actualizar cliente
    @Override
    @Transactional
    public Cliente actualizarCliente(Long id, String nuevoNumero_documento, String nuevoNombre, String nuevaDireccion, String nuevoEmail, String nuevoTelefono, String nuevaCiudad) {
        Cliente cliente = obtenerCliente(id);
        cliente.setNumero_documento(nuevoNumero_documento);
        cliente.setNombre(nuevoNombre);
        cliente.setDireccion(nuevaDireccion);
        cliente.setEmail(nuevoEmail);
        cliente.setTelefono(nuevoTelefono);
        cliente.setCiudad(nuevaCiudad);
        return clienteRepository.save(cliente);
    }

    // Eliminar cliente
    @Override
    @Transactional
    public void eliminarCliente(Long id) {
        Cliente cliente = obtenerCliente(id);
        clienteRepository.delete(cliente);
    }
}