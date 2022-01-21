import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuardService } from '../share/auth-guard.service';
import { RolGuardService } from '../share/rol-guard.service';
import { FacturaAllComponent } from './factura-all/factura-all.component';
import { FacturaCreateComponent } from './factura-create/factura-create.component';


const routes: Routes = [
  {
    path: 'factura/all',
    component: FacturaAllComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 2 },
  },
  {
    path: 'factura/create',
    component: FacturaCreateComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 2 },
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FacturaRoutingModule {}
