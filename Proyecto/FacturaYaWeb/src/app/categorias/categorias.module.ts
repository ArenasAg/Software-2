import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { CategoriasComponent } from './categorias.component';
import { CategoriasRoutingModule } from './categorias-routing.module';

@NgModule({
  declarations: [
    CategoriasComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    CategoriasRoutingModule
  ]
})
export class CategoriasModule { }