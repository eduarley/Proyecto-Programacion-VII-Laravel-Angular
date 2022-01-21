import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router } from '@angular/router';
import { AuthenticationService } from './authentication.service';

@Injectable({
  providedIn: 'root',
})
export class RolGuardService implements CanActivate {
  constructor(private auth: AuthenticationService, private router: Router) {}

  canActivate(route: ActivatedRouteSnapshot): boolean {
    let currentUser: any;
    this.auth.currentUser.subscribe((x) => (currentUser = x));
    const expectedRole = route.data.expectedRole;

    if (!currentUser || currentUser.user.rol_id != expectedRole) {
      if (!this.auth.currentUserValue) {
        this.router.navigate(['/producto/index/'], {
          queryParams: { auth: 'true' },
        });
        return false;
      }
    }
    return true;
  }
}
