import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FacturaRoutingModule } from './factura-routing.module';
import { FacturaAllComponent } from './factura-all/factura-all.component';
import { FacturaCreateComponent } from './factura-create/factura-create.component';
import { ReactiveFormsModule } from '@angular/forms';


@NgModule({
  declarations: [FacturaAllComponent, FacturaCreateComponent],
  imports: [CommonModule, FacturaRoutingModule, ReactiveFormsModule],
})
export class FacturaModule {}
