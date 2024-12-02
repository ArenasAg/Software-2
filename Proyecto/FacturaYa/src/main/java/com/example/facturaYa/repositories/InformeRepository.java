package com.example.facturaYa.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.facturaYa.models.Informe;

public interface InformeRepository extends JpaRepository<Informe, Long> {
    // Métodos personalizados de consulta si es necesario
    
}
