package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;

public interface CategoriaBridge {
    void mostrarCategoria(Categoria categoria);
}

class CategoriaBasica implements CategoriaBridge {
    @Override
    public void mostrarCategoria(Categoria categoria) {
        System.out.println("Categoria: " + categoria.getNombre());
    }
}
