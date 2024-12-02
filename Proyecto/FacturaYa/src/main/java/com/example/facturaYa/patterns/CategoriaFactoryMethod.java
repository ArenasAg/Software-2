package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;

public class CategoriaFactoryMethod {
    public static Categoria crearCategoria(String tipo) {
        if ("VIP".equalsIgnoreCase(tipo)) {
            return new Categoria("VIP");
        } else {
            return new Categoria("Estandar");
        }
    }
}
