package com.example.facturaYa.repositories;

import com.example.facturaYa.models.DetalleFactura;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

public interface DetalleFacturaRepository extends JpaRepository<DetalleFactura, Long> {
    
    
    @Query("SELECT d FROM DetalleFactura d WHERE d.factura.id = :facturaId")
    DetalleFactura findByFacturaId(@Param("facturaId") Long facturaId);
}
