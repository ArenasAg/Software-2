package com.example.facturaYa.repositories;

import com.example.facturaYa.models.InventarioDetalle;
import org.springframework.data.jpa.repository.JpaRepository;

public interface InventarioDetalleRepository extends JpaRepository<InventarioDetalle, Long> {
    // Métodos personalizados de consulta si es necesario

    
}
