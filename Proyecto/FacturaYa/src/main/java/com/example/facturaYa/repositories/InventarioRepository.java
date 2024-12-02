package com.example.facturaYa.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.facturaYa.models.Inventario;

public interface InventarioRepository extends JpaRepository<Inventario, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
