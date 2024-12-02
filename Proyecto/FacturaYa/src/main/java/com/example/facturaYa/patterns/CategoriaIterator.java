package com.example.facturaYa.patterns;

import com.example.facturaYa.models.Categoria;
import java.util.Iterator;
import java.util.List;

public class CategoriaIterator implements Iterator<Categoria> {
    private List<Categoria> categorias;
    private int position;

    public CategoriaIterator(List<Categoria> categorias) {
        this.categorias = categorias;
        this.position = 0;
    }

    @Override
    public boolean hasNext() {
        return position < categorias.size();
    }

    @Override
    public Categoria next() {
        return categorias.get(position++);
    }
}
