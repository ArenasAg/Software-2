package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;

public class CategoriaBuilder {
    private String nombre;

    public CategoriaBuilder setNombre(String nombre) {
        this.nombre = nombre;
        return this;
    }

    public Categoria build() {
        return new Categoria(nombre);
    }
}
