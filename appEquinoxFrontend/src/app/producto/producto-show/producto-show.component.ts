import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { GenericService } from 'src/app/share/generic.service';


@Component({
  selector: 'app-producto-show',
  templateUrl: './producto-show.component.html',
  styleUrls: ['./producto-show.component.css'],

})
export class ProductoShowComponent implements OnInit {
  datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private route: ActivatedRoute,
    private gService: GenericService
  ) { }

  ngOnInit(): void {

    //Obtener el id del personal
    let id = +this.route.snapshot.paramMap.get('id');
    this.obtenerPersonal(id);
  }


  obtenerPersonal(id: any) {

    this.gService
      .get('producto', id)
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
