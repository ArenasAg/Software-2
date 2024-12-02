package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;
import com.example.facturaYa.services.CategoriaService;

public class CategoriaFacade {
    private CategoriaService categoriaService;

    public CategoriaFacade(CategoriaService categoriaService) {
        this.categoriaService = categoriaService;
    }

    public Categoria procesarCategoria(String nombre) {
        Categoria categoria = new Categoria(nombre);
        return categoriaService.crearCategoria(categoria.getNombre());
    }
}
