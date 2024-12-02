package com.example.facturaYa.services;

import com.example.facturaYa.models.Informe;
import com.example.facturaYa.repositories.InformeRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;
import java.time.LocalDate;
import java.util.List;

@Service
public class InformeService implements IInformeService {

    private final InformeRepository informeRepository;

    @Autowired
    public InformeService(InformeRepository informeRepository) {
        this.informeRepository = informeRepository;
    }

    @Override
    @Transactional
    public Informe crearInforme(LocalDate fecha, String tipoInforme, String datosJson) {
        Informe informe = new Informe(fecha, tipoInforme, datosJson);
        return informeRepository.save(informe);
    }

    @Override
    public Informe obtenerInforme(Long id) {
        return informeRepository.findById(id).orElseThrow(() -> new RuntimeException("Informe no encontrado"));
    }

    @Override
    public List<Informe> obtenerTodosLosInformes() {
        return informeRepository.findAll();
    }

    @Override
    @Transactional
    public Informe actualizarInforme(Long id, LocalDate nuevaFecha, String nuevoTipoInforme, String nuevosDatosJson) {
        Informe informe = obtenerInforme(id);
        informe.setFecha(nuevaFecha);
        informe.setTipoInforme(nuevoTipoInforme);
        informe.setDatosJson(nuevosDatosJson);
        return informeRepository.save(informe);
    }

    @Override
    @Transactional
    public void eliminarInforme(Long id) {
        Informe informe = obtenerInforme(id);
        informeRepository.delete(informe);
    }
}
