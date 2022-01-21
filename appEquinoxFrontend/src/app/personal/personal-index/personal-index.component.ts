import { Component, OnInit } from '@angular/core';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-personal-index',
  templateUrl: './personal-index.component.html',
  styleUrls: ['./personal-index.component.css'],
})
export class PersonalIndexComponent implements OnInit {
  datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    this.listarPersonal();
  }

  ngOnInit(): void {}

  listarPersonal() {
    this.gService
      .list('personal/')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        //console.log(data);
        this.datos = data;
      });
  }

  ngOnDestroy() {
    this.destroy$.next(true);
    //Desinscribirse
    this.destroy$.unsubscribe();
  }
}
