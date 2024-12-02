package com.example.facturaYa.services;

import com.example.facturaYa.models.Categoria;
import com.example.facturaYa.models.Impuesto;
import com.example.facturaYa.models.Producto;
import com.example.facturaYa.repositories.ProductoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.math.BigDecimal;
import java.util.List;

@Service
public class ProductoService implements IProductoService {

    private final ProductoRepository productoRepository;

    @Autowired
    public ProductoService(ProductoRepository productoRepository) {
        this.productoRepository = productoRepository;
    }

    @Override
    @Transactional
    public Producto crearProducto(String codigo, String nombre, String imagen, BigDecimal precio, BigDecimal medida, Integer stock, Categoria categoria, Impuesto impuesto) {
        Producto producto = new Producto(codigo, nombre, imagen, precio, medida, stock, categoria, impuesto);
        return productoRepository.save(producto);
    }

    @Override
    public Producto obtenerProducto(Long id) {
        return productoRepository.findById(id).orElseThrow(() -> new RuntimeException("Producto no encontrado"));
    }

    @Override
    public List<Producto> obtenerTodosLosProductos() {
        return productoRepository.findAll();
    }

    @Override
    @Transactional
    public Producto actualizarProducto(Long id, String nuevoCodigo, String nuevoNombre, String nuevaImagen, BigDecimal nuevoPrecio, BigDecimal nuevaMedida, Integer nuevoStock, Categoria nuevaCategoria, Impuesto nuevoImpuesto) {
        Producto producto = obtenerProducto(id);
        producto.setNombre(nuevoNombre);
        producto.setImagen(nuevaImagen);
        producto.setPrecio(nuevoPrecio);
        producto.setMedida(nuevaMedida);
        producto.setStock(nuevoStock);
        producto.setCategoria(nuevaCategoria);
        producto.setImpuesto(nuevoImpuesto);
        return productoRepository.save(producto);
    }

    @Override
    @Transactional
    public void eliminarProducto(Long id) {
        Producto producto = obtenerProducto(id);
        productoRepository.delete(producto);
    }
}