package com.example.facturaYa.repositories;

import com.example.facturaYa.models.Impuesto;

import org.springframework.data.jpa.repository.JpaRepository;

public interface ImpuestoRepository extends JpaRepository<Impuesto, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
