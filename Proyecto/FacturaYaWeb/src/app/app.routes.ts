import { Routes } from '@angular/router';

export const routes: Routes = [
  { path: 'clientes', loadChildren: () => import('./clientes/clientes.module').then(m => m.ClientesModule) },
  { path: 'categorias', loadChildren: () => import('./categorias/categorias.module').then(m => m.CategoriasModule) },
  { path: 'facturas', loadChildren: () => import('./facturas/facturas.module').then(m => m.FacturasModule) },
  { path: '', redirectTo: '/clientes', pathMatch: 'full' }
];
