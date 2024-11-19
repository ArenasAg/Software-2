import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ClientesComponent } from './clientes.component';
import { ClientesRoutingModule } from './clientes-routing.module';

@NgModule({
  declarations: [
    ClientesComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    ClientesRoutingModule
  ]
})
export class ClientesModule { }
