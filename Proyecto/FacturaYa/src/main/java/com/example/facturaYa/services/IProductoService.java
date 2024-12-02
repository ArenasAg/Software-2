package com.example.facturaYa.services;

import java.math.BigDecimal;
import java.util.List;

import com.example.facturaYa.models.Categoria;
import com.example.facturaYa.models.Impuesto;
import com.example.facturaYa.models.Producto;

public interface IProductoService {
    Producto crearProducto(String codigo, String nombre, String imagen, BigDecimal precio, BigDecimal medida, Integer stock, Categoria categoria, Impuesto impuesto);
    Producto obtenerProducto(Long id);
    List<Producto> obtenerTodosLosProductos();
    Producto actualizarProducto(Long id, String nuevoCodigo, String nuevoNombre, String nuevaImagen, BigDecimal nuevoPrecio, BigDecimal nuevaMedida, Integer nuevoStock, Categoria nuevaCategoria, Impuesto nuevoImpuesto);
    void eliminarProducto(Long id);
}
