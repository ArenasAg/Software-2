import { Component, OnInit } from '@angular/core';
import { ClientesService } from './clientes.service';

@Component({
  selector: 'app-clientes',
  templateUrl: './clientes.component.html',
  styleUrls: ['../../assets/css/style.css']
})
export class ClientesComponent implements OnInit {
  clientes: any[] = [];
  selectedCliente: any = {};

  constructor(private clientesService: ClientesService) {}

  ngOnInit(): void {
    this.loadClientes();
  }

  loadClientes(): void {
    this.clientesService.getClientes().subscribe(
      data => {
        this.clientes = data;
      },
      error => {
        console.error('Error al obtener los clientes', error);
      }
    );
  }

  createCliente(cliente: any): void {
    this.clientesService.createCliente(cliente).subscribe(
      data => {
        this.loadClientes();
      },
      error => {
        console.error('Error al crear el cliente', error);
      }
    );
  }

  updateCliente(cliente: any): void {
    this.clientesService.updateCliente(cliente.id, cliente).subscribe(
      data => {
        this.loadClientes();
      },
      error => {
        console.error('Error al actualizar el cliente', error);
      }
    );
  }

  deleteCliente(id: number): void {
    if (confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
      this.clientesService.deleteCliente(id).subscribe(
        data => {
          this.loadClientes();
        },
        error => {
          console.error('Error al eliminar el cliente', error);
        }
      );
    }
  }

  selectCliente(cliente: any): void {
    this.selectedCliente = cliente ? { ...cliente } : {};
  }
}