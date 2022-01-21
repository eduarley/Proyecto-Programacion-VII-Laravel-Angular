import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProductoRoutingModule } from './producto-routing.module';
import { ProductoAllComponent } from './producto-all/producto-all.component';
import { ProductoIndexComponent } from './producto-index/producto-index.component';
import { ProductoShowComponent } from './producto-show/producto-show.component';
import { ProductoCreateComponent } from './producto-create/producto-create.component';
import { ReactiveFormsModule } from '@angular/forms';
import { ProductoUpdateComponent } from './producto-update/producto-update.component';

@NgModule({
  declarations: [
    ProductoAllComponent,
    ProductoIndexComponent,
    ProductoShowComponent,
    ProductoCreateComponent,
    ProductoUpdateComponent,
  ],
  imports: [CommonModule, ProductoRoutingModule, ReactiveFormsModule],
})
export class ProductoModule {}
