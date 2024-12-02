package com.example.facturaYa.services;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import com.example.facturaYa.models.Categoria;
import com.example.facturaYa.repositories.CategoriaRepository;

import java.util.List;

@Service
public class CategoriaService implements ICategoriaService {

    private final CategoriaRepository categoriaRepository;

    @Autowired
    public CategoriaService(CategoriaRepository categoriaRepository) {
        this.categoriaRepository = categoriaRepository;
    }

    // Crear categoría
    @Override
    @Transactional
    public Categoria crearCategoria(String nombre) {
        Categoria categoria = new Categoria(nombre);
        return categoriaRepository.save(categoria);
    }

    // Obtener categoría por ID
    @Override
    public Categoria obtenerCategoria(Long id) {
        return categoriaRepository.findById(id).orElseThrow(() -> new RuntimeException("Categoría no encontrada"));
    }

    // Obtener todas las categorías
    @Override
    public List<Categoria> obtenerTodasLasCategorias() {
        return categoriaRepository.findAll();
    }

    // Actualizar categoría
    @Override
    @Transactional
    public Categoria actualizarCategoria(Long id, String nuevoNombre) {
        Categoria categoria = obtenerCategoria(id);
        categoria.setNombre(nuevoNombre);
        return categoriaRepository.save(categoria);
    }

    // Eliminar categoría
    @Override
    @Transactional
    public void eliminarCategoria(Long id) {
        Categoria categoria = obtenerCategoria(id);
        categoriaRepository.delete(categoria);
    }
}