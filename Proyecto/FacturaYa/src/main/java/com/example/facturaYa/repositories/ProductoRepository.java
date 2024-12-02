package com.example.facturaYa.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.facturaYa.models.Producto;

public interface ProductoRepository extends JpaRepository<Producto, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
