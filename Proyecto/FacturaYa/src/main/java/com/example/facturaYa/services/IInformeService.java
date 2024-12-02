package com.example.facturaYa.services;

import java.time.LocalDate;
import java.util.List;

import com.example.facturaYa.models.Informe;

public interface IInformeService {
    Informe crearInforme(LocalDate fecha, String tipoInforme, String datosJson);
    Informe obtenerInforme(Long id);
    List<Informe> obtenerTodosLosInformes();
    Informe actualizarInforme(Long id, LocalDate nuevaFecha, String nuevoTipoInforme, String nuevosDatosJson);
    void eliminarInforme(Long id);
}