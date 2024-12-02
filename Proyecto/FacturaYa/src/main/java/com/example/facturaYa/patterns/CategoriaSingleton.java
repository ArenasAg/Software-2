package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;

public class CategoriaSingleton {
    private static CategoriaSingleton instance;

    private Categoria categoria;

    private CategoriaSingleton() {}

    public static CategoriaSingleton getInstance() {
        if (instance == null) {
            instance = new CategoriaSingleton();
        }
        return instance;
    }

    public Categoria getCategoria() {
        if (categoria == null) {
            categoria = new Categoria("Default");
        }
        return categoria;
    }
}
