//import { DatePipe } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CustomDatePipe } from 'src/app/pipes/custom-date.pipe';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-pedido-all',
  templateUrl: './pedido-all.component.html',
  styleUrls: ['./pedido-all.component.css'],
})
export class PedidoAllComponent implements OnInit {
  datos: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  error: any;

  constructor(
    public fb: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService, //public datepipe: DatePipe
    private noti: NotificacionService
  ) {}

  ngOnInit(): void {
    this.listaPedidos();
  }

  listaPedidos() {
    this.gService
      .list('pedido/all')
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        //this.datepipe.transform(data.fecha, 'yyyy/MM/dd');
        this.datos = data;
      });
  }

  redirectTo(uri: string) {
    this.router
      .navigateByUrl('/', { skipLocationChange: true })
      .then(() => this.router.navigate([uri]));
  }

  actualizarEstado(item) {

    if(item.personal_id==null && item.tipo_pedido =='Express'){
      alert('Primero debes asignar un personal de entrega');
      return;
    }


    let formData = new FormData();
    formData = this.gService.toFormData(item);
    formData.append('_method', 'PATCH') ;

    this.gService
      .update_formdata('pedido', formData)
      .subscribe((respuesta: any) => {
        this.redirectTo('/pedido/all');

        this.noti.mensaje(
          'Pedido',
          'Se cambió el estado satisfactoriamente',
          'success'
        );
      });
  }

  asignarPersonal(id: number) {
    this.router.navigate(['/pedido/pedidopersonal', id], {
      relativeTo: this.route,
    });
  }
}
