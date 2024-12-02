package com.example.facturaYa.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.facturaYa.models.MetodoPago;

public interface MetodoPagoRepository extends JpaRepository<MetodoPago, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
