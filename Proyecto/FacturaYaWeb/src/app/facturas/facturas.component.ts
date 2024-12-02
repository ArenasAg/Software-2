import { Component, OnInit } from '@angular/core';
import { FacturasService } from './facturas.service';

@Component({
  selector: 'app-facturas',
  templateUrl: './facturas.component.html',
  styleUrls: ['../../assets/css/style.css']
})
export class FacturasComponent implements OnInit {
  facturas: any[] = [];
  clientes: any[] = [];
  metodoPagos: any[] = [];
  selectedFactura: any = {};
  showFactura: any = {};

  constructor(private facturasService: FacturasService) {}

  ngOnInit(): void {
    this.loadFacturas();
    this.loadClientes();
    this.loadMetodoPagos();
  }

  loadFacturas(): void {
    this.facturasService.getFacturas().subscribe(
      (data) => {
        this.facturas = data;
      },
      (error) => {
        console.error('Error al obtener las facturas', error);
      }
    );
  }

  loadClientes(): void {
    this.facturasService.getClientes().subscribe(
      (data) => {
        this.clientes = data;
      },
      (error) => {
        console.error('Error al obtener los clientes', error);
      }
    );
  }

  loadMetodoPagos(): void {
    this.facturasService.getMetodoPagos().subscribe(
      (data) => {
        this.metodoPagos = data;
      },
      (error) => {
        console.error('Error al obtener los métodos de pago', error);
      }
    );
  }

  createFactura(factura: any): void {
    console.log("Datos de la factura", factura);
    this.facturasService.createFactura(factura).subscribe(
      () => {
        this.loadFacturas();
      },
      (error) => {
        console.error('Error al crear la factura', error);
      }
    );
  }

  updateFactura(factura: any): void {
    if (this.selectedFactura) {
      this.facturasService.updateFactura(factura.id, factura).subscribe(
        () => {
          this.loadFacturas();
        },
        (error) => {
          console.error('Error al actualizar la factura', error);
        }
      );
    }
  }

  deleteFactura(id: number): void {
    this.facturasService.deleteFactura(id).subscribe(
      () => {
        this.loadFacturas();
      },
      (error) => {
        console.error('Error al eliminar la factura', error);
      }
    );
  }

  selectFactura(factura: any): void {
    this.selectedFactura = { ...factura };
  }

  viewFactura(factura: any): void {
    this.facturasService.getDetalleFactura(factura.id).subscribe(
      (data) => {
        for (const cliente of this.clientes) {
          if (cliente.id === factura.cliente.id) {
            this.showFactura = { cliente: cliente, factura: factura, detalles: Array.isArray(data) ? data : [data] };
          }
        }
      },
      (error) => {
        console.error('Error al obtener los métodos de pago', error);
      }
    );
  }
}