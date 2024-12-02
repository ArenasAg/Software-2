package com.example.facturaYa.services;

import com.example.facturaYa.models.Inventario;
import com.example.facturaYa.repositories.InventarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import java.time.LocalDate;
import java.util.List;


@Service
public class InventarioService implements IInventarioService {

    private final InventarioRepository inventarioRepository;

    @Autowired
    public InventarioService(InventarioRepository inventarioRepository) {
        this.inventarioRepository = inventarioRepository;
    }

    @Override
    @Transactional
    public Inventario crearInventario(LocalDate fecha, String tipoMovimiento) {
        Inventario inventario = new Inventario(fecha, tipoMovimiento);
        return inventarioRepository.save(inventario);
    }

    @Override
    public Inventario obtenerInventario(Long id) {
        return inventarioRepository.findById(id).orElseThrow(() -> new RuntimeException("Inventario no encontrado"));
    }

    @Override
    public List<Inventario> obtenerTodosLosInventarios() {
        return inventarioRepository.findAll();
    }

    @Override
    @Transactional
    public Inventario actualizarInventario(Long id, LocalDate nuevaFecha, String nuevoTipoMovimiento) {
        Inventario inventario = obtenerInventario(id);
        inventario.setFecha(nuevaFecha);
        inventario.setTipoMovimiento(nuevoTipoMovimiento);
        return inventarioRepository.save(inventario);
    }

    @Override
    @Transactional
    public void eliminarInventario(Long id) {
        Inventario inventario = obtenerInventario(id);
        inventarioRepository.delete(inventario);
    }
}