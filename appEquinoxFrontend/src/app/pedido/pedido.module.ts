import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PedidoRoutingModule } from './pedido-routing.module';
import { PedidoAllComponent } from './pedido-all/pedido-all.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { PedidoIndexComponent } from './pedido-index/pedido-index.component';
import { PedidoEstadoComponent } from './pedido-estado/pedido-estado.component';
import { PedidoPersonalComponent } from './pedido-personal/pedido-personal.component';

@NgModule({
  declarations: [PedidoAllComponent, PedidoIndexComponent, PedidoEstadoComponent, PedidoPersonalComponent],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    PedidoRoutingModule,
  ],
})
export class PedidoModule {}
