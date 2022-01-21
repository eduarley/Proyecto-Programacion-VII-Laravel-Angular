import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuardService } from '../share/auth-guard.service';
import { RolGuardService } from '../share/rol-guard.service';
import { PersonalAllComponent } from './personal-all/personal-all.component';
import { PersonalCreateComponent } from './personal-create/personal-create.component';
import { PersonalIndexComponent } from './personal-index/personal-index.component';
import { PersonalShowComponent } from './personal-show/personal-show.component';
import { PersonalUpdateComponent } from './personal-update/personal-update.component';

const routes: Routes = [
  {
    path: 'personal/index',
    component: PersonalIndexComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 1 },
  },
  {
    path: 'personal/all',
    component: PersonalAllComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 1 },
  },
  {
    path: 'personal/create',
    component: PersonalCreateComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 1 },
  },
  {
    path: 'personal/:id',
    component: PersonalShowComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 1 },
  },
  {
    path: 'personal/update/:id',
    component: PersonalUpdateComponent,
    canActivate: [AuthGuardService, RolGuardService],
    data: { expectedRole: 1 },
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class PersonalRoutingModule {}
