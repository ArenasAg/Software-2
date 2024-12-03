package com.example.facturaYa.services;

import java.time.LocalDateTime;
import java.util.List;

import com.example.facturaYa.models.Informe;

public interface IInformeService {
    Informe crearInforme(LocalDateTime fecha, String tipoInforme, String datosJson);
    Informe obtenerInforme(Long id);
    List<Informe> obtenerTodosLosInformes();
    Informe actualizarInforme(Long id, LocalDateTime nuevaFecha, String nuevoTipoInforme, String nuevosDatosJson);
    void eliminarInforme(Long id);
}