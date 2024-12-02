package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;

public class CategoriaMediator {
    private Categoria categoria;

    public void setCategoria(Categoria categoria) {
        this.categoria = categoria;
    }

    public void mostrarCategoria() {
        System.out.println("La categoría es: " + categoria.getNombre());
    }
}
