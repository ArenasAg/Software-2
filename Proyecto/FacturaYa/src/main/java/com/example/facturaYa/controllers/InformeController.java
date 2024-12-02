package com.example.facturaYa.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import com.example.facturaYa.models.Informe;
import com.example.facturaYa.services.InformeService;
import java.util.List;

@RestController
@RequestMapping("api/informes")
public class InformeController {

    private final InformeService informeService;

    @Autowired
    public InformeController(InformeService informeService) {
        this.informeService = informeService;
    }

    // Crear un nuevo informe
    @PostMapping
    public ResponseEntity<Informe> crearInforme(@RequestBody Informe informe) {
        Informe informeCreado = informeService.crearInforme(informe.getFecha(), informe.getTipoInforme(), informe.getDatosJson());
        return ResponseEntity.status(HttpStatus.CREATED).body(informeCreado);
    }

    // Obtener un informe por ID
    @GetMapping("/{id}")
    public ResponseEntity<Informe> obtenerInforme(@PathVariable Long id) {
        Informe informe = informeService.obtenerInforme(id);
        return ResponseEntity.ok(informe);
    }

    // Obtener todos los informes
    @GetMapping
    public ResponseEntity<List<Informe>> obtenerTodosLosInformes() {
        List<Informe> informes = informeService.obtenerTodosLosInformes();
        return ResponseEntity.ok(informes);
    }

    // Actualizar un informe
    @PutMapping("/{id}")
    public ResponseEntity<Informe> actualizarInforme(@PathVariable Long id, @RequestBody Informe informe) {
        Informe informeActualizado = informeService.actualizarInforme(id, informe.getFecha(), informe.getTipoInforme(), informe.getDatosJson());
        return ResponseEntity.ok(informeActualizado);
    }

    // Eliminar un informe
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminarInforme(@PathVariable Long id) {
        informeService.eliminarInforme(id);
        return ResponseEntity.noContent().build();
    }
}