package com.example.facturaYa.factories;

import java.math.BigDecimal;

import com.example.facturaYa.models.Categoria;
import com.example.facturaYa.models.Impuesto;
import com.example.facturaYa.models.Producto;

public class ProductoFactory {
    public static Producto crearProducto(String codigo, String nombre, String imagen, BigDecimal precio, BigDecimal medida, Integer stock, Categoria categoria, Impuesto impuesto) {
        return new Producto(codigo, nombre, imagen, precio, medida, stock, categoria, impuesto);
    }
}
