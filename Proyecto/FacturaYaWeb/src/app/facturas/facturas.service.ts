import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError, tap } from 'rxjs/operators';
import Swal from 'sweetalert2';

@Injectable({
  providedIn: 'root'
})
export class FacturasService {
  private apiUrl = 'http://localhost:8080/api/facturas';

  constructor(private http: HttpClient) {}

  getFacturas(): Observable<any> {
    return this.http.get<any>(this.apiUrl).pipe(
      catchError(this.handleError)
    );
  }

  getClientes(): Observable<any> {
    return this.http.get<any>('http://localhost:8080/api/clientes').pipe(
      catchError(this.handleError)
    );
  }

  getMetodoPagos(): Observable<any> {
    return this.http.get<any>('http://localhost:8080/api/metodos-pago').pipe(
      catchError(this.handleError)
    );
  }

  getDetalleFactura(id: number): Observable<any> {
    return this.http.get<any>(`http://localhost:8080/api/facturas/${id}/detalles`).pipe(
      catchError(this.handleError)
    );
  }

  createFactura(factura: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, factura).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Factura creada con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  updateFactura(id: number, factura: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, factura).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Factura actualizada con éxito',
          showConfirmButton: false,
          timer: 1500,
          toast: true
        });
      }),
      catchError(this.handleError)
    );
  }

  deleteFactura(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`).pipe(
      tap(() => {
        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          title: 'Factura eliminada con éxito',
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