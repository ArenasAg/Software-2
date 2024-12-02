package com.example.facturaYa.repositories;

import com.example.facturaYa.models.Cliente;

import org.springframework.data.jpa.repository.JpaRepository;

public interface ClienteRepository extends JpaRepository<Cliente, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
