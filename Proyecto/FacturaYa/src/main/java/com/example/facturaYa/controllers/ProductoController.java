package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.Producto;
import com.example.facturaYa.services.ProductoService;
import java.util.List;

@RestController
@RequestMapping("api/productos")
public class ProductoController {

    private final ProductoService productoService;

    @Autowired
    public ProductoController(ProductoService productoService) {
        this.productoService = productoService;
    }

    // Crear un nuevo producto
    @PostMapping
    public ResponseEntity<Producto> crearProducto(@RequestBody Producto producto) {
        Producto productoCreado = productoService.crearProducto(producto.getCodigo(), producto.getNombre(), producto.getImagen(), producto.getPrecio(), producto.getMedida(), producto.getStock(), producto.getCategoria(), producto.getImpuesto());
        return ResponseEntity.status(HttpStatus.CREATED).body(productoCreado);
    }

    // Obtener un producto por ID
    @GetMapping("/{id}")
    public ResponseEntity<Producto> obtenerProducto(@PathVariable Long id) {
        Producto producto = productoService.obtenerProducto(id);
        return ResponseEntity.ok(producto);
    }

    // Obtener todos los productos
    @GetMapping
    public ResponseEntity<List<Producto>> obtenerTodosLosProductos() {
        List<Producto> productos = productoService.obtenerTodosLosProductos();
        return ResponseEntity.ok(productos);
    }

    // Actualizar un producto
    @PutMapping("/{id}")
    public ResponseEntity<Producto> actualizarProducto(@PathVariable Long id, @RequestBody Producto producto) {
        Producto productoActualizado = productoService.actualizarProducto(id, producto.getCodigo(), producto.getNombre(), producto.getImagen(), producto.getPrecio(), producto.getMedida(), producto.getStock(), producto.getCategoria(), producto.getImpuesto());
        return ResponseEntity.ok(productoActualizado);
    }

    // Eliminar un producto
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarProducto(@PathVariable Long id) {
        productoService.eliminarProducto(id);
        return ResponseEntity.noContent().build();
    }
}