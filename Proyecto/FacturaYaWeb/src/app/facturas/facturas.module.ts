import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { FacturasComponent } from './facturas.component';
import { FacturasRoutingModule } from './facturas-routing.module';

@NgModule({
  declarations: [
    FacturasComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    FacturasRoutingModule
  ]
})
export class FacturasModule { }
