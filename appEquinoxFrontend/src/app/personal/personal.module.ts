import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PersonalRoutingModule } from './personal-routing.module';
import { PersonalIndexComponent } from './personal-index/personal-index.component';
import { PersonalAllComponent } from './personal-all/personal-all.component';
import { PersonalShowComponent } from './personal-show/personal-show.component';
import { PersonalCreateComponent } from './personal-create/personal-create.component';
import { ReactiveFormsModule } from '@angular/forms';
import { PersonalUpdateComponent } from './personal-update/personal-update.component';

@NgModule({
  declarations: [
    PersonalIndexComponent,
    PersonalAllComponent,
    PersonalShowComponent,
    PersonalCreateComponent,
    PersonalUpdateComponent,
  ],
  imports: [CommonModule, PersonalRoutingModule, ReactiveFormsModule],
})
export class PersonalModule {}
