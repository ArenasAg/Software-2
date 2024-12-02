import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, tap } from 'rxjs/operators';
import Swal from 'sweetalert2';

@Injectable({
  providedIn: 'root'
})
export class ClientesService {
  private apiUrl = 'http://localhost:8080/api/clientes';

  constructor(private http: HttpClient) {}

  getClientes(): Observable<any> {
    return this.http.get<any>(this.apiUrl).pipe(
      catchError(this.handleError)
    );
  }

  createCliente(cliente: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, cliente).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Cliente creado con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  updateCliente(id: number, cliente: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, cliente).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Cliente actualizado con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  deleteCliente(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Cliente eliminado con éxito',
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