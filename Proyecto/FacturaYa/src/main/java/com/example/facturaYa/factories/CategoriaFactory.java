package com.example.facturaYa.factories;

import com.example.facturaYa.models.Categoria;

public class CategoriaFactory {
    public static Categoria crearCategoria(String nombre) {
        return new Categoria(nombre);
    }
}
