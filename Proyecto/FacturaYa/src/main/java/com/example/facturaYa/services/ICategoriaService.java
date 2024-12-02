package com.example.facturaYa.services;

import com.example.facturaYa.models.Categoria;

import java.util.List;

public interface ICategoriaService {
    Categoria crearCategoria(String nombre);
    Categoria obtenerCategoria(Long id);
    List<Categoria> obtenerTodasLasCategorias();
    Categoria actualizarCategoria(Long id, String nuevoNombre);
    void eliminarCategoria(Long id);
}