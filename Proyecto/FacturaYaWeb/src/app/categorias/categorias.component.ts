import { Component, OnInit } from '@angular/core';
import { CategoriasService } from './categorias.service';

@Component({
  selector: 'app-categorias',
  templateUrl: './categorias.component.html',
  styleUrls: ['../../assets/css/style.css']
})
export class CategoriasComponent implements OnInit {
  categorias: any[] = [];
  selectedCategoria: any = {};

  constructor(private categoriasService: CategoriasService) {}

  ngOnInit(): void {
    this.loadCategorias();
  }

  loadCategorias(): void {
    this.categoriasService.getCategorias().subscribe(
      (data) => {
        this.categorias = data;
      },
      (error) => {
        console.error('Error al obtener las categorías', error);
      }
    );
  }

  createCategoria(categoria: any): void {
    this.categoriasService.createCategoria(categoria).subscribe(
      () => {
        this.loadCategorias();
      },
      (error) => {
        console.error('Error al crear la categoría', error);
      }
    );
  }

  updateCategoria(categoria: any): void {
    if (this.selectedCategoria) {
      this.categoriasService.updateCategoria(categoria.id, categoria).subscribe(
        () => {
          this.loadCategorias();
        },
        (error) => {
          console.error('Error al actualizar la categoría', error);
        }
      );
    }
  }

  deleteCategoria(id: number): void {
    this.categoriasService.deleteCategoria(id).subscribe(
      () => {
        this.loadCategorias();
      },
      (error) => {
        console.error('Error al eliminar la categoría', error);
      }
    );
  }

  selectCategoria(categoria: any): void {
    this.selectedCategoria = { ...categoria };
  }
}