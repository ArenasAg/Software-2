package com.example.facturaYa.repositories;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.facturaYa.models.Categoria;

public interface CategoriaRepository extends JpaRepository<Categoria, Long> {
    // Métodos personalizados de consulta si es necesario
}
