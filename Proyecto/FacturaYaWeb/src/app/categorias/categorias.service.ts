import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, tap } from 'rxjs/operators';
import Swal from 'sweetalert2';

@Injectable({
  providedIn: 'root'
})
export class CategoriasService {
  private apiUrl = 'http://localhost:8080/api/categorias';

  constructor(private http: HttpClient) {}

  getCategorias(): Observable<any> {
    return this.http.get<any>(this.apiUrl).pipe(
      catchError(this.handleError)
    );
  }

  createCategoria(categoria: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, categoria).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Categoría creada con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  updateCategoria(id: number, categoria: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, categoria).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Categoría actualizada con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  deleteCategoria(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Categoría eliminada con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  private handleError(error: any): Observable<never> {
    Swal.fire({
      position: 'bottom-end',
      icon: 'error',
      title: 'Ocurrió un error',
      text: error.message,
      showConfirmButton: false,
      timer: 3000,
      toast: true
    });
    return throwError(error);
  }
}