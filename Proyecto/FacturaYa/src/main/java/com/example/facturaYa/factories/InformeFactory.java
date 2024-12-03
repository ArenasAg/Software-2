package com.example.facturaYa.factories;

import java.time.LocalDateTime;

import com.example.facturaYa.models.Informe;

public class InformeFactory {

    public static Informe crearInforme(LocalDateTime fecha, String tipoInforme, String datosJson){
        return new Informe(fecha, tipoInforme, datosJson);
    }
}