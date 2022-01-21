import { Route } from '@angular/compiler/src/core';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';

@Component({
  selector: 'app-personal-all',
  templateUrl: './personal-all.component.html',
  styleUrls: ['./personal-all.component.css'],
})
export class PersonalAllComponent implements OnInit {
  datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService
  ) {}

  ngOnInit(): void {
    this.listaPersonal();
  }

  listaPersonal() {
    this.gService
      .list('personal/all')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        //console.log(data);
        this.datos = data;
      });
  }

  ngOnDestroy() {
    this.destroy$.next(true);
    // Desinscribirse
    this.destroy$.unsubscribe();
  }
  actualizarPersonal(id: number) {
    this.router.navigate(['/personal/update', id], {
      relativeTo: this.route,
    });
  }
  crearPersonal() {
    this.router.navigate(['/personal/create'], {
      relativeTo: this.route,
    });
  }
}
