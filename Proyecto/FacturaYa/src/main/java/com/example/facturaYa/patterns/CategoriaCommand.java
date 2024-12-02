package com.example.facturaYa.patterns;

import com.example.facturaYa.services.CategoriaService;

public class CategoriaCommand {
    private CategoriaService categoriaService;
    private String nombre;

    public CategoriaCommand(CategoriaService categoriaService, String nombre) {
        this.categoriaService = categoriaService;
        this.nombre = nombre;
    }

    public void execute() {
        categoriaService.crearCategoria(nombre);
    }
}
