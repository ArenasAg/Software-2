package com.example.facturaYa.factories;

import java.time.LocalDate;

import com.example.facturaYa.models.Informe;

public class InformeFactory {

    public static Informe crearInforme(LocalDate fecha, String tipoInforme, String datosJson){
        return new Informe(fecha, tipoInforme, datosJson);
    }
}