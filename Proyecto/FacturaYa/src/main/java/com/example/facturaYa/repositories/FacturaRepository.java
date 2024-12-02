package com.example.facturaYa.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.facturaYa.models.Factura;

public interface FacturaRepository extends JpaRepository<Factura, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
