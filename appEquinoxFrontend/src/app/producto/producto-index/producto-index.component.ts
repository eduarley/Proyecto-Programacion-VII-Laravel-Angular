import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CartService } from 'src/app/share/cart.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-producto-index',
  templateUrl: './producto-index.component.html',
  styleUrls: ['./producto-index.component.css'],
})
export class ProductoIndexComponent implements OnInit {
  datos: any;
  infoProducto: any;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    private gService: GenericService,
    private notificacion: NotificacionService,
    private cartService: CartService,
    private route: ActivatedRoute
  ) {
    this.listarProductos();
  }

  ngOnInit(): void {
    this.mensajes();
  }

  mensajes() {
    let auth = false;
    this.route.queryParams.subscribe((params) => {
      auth = params.auth || false;
    });

    if (auth) {
      this.notificacion.mensaje(
        'Usuario',
        'Usuario no autorizado para ingresar al recurso solicitado',
        'warning'
      );
    }
  }

  listarProductos() {
    this.gService
      .list('producto/')
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

  agregarProducto(id: number) {
    this.gService
      .get('producto', id)
      .pipe(takeUntil(this.destroy$))
      .subscribe((data: any) => {
        this.infoProducto = data;
        this.cartService.addToCart(this.infoProducto);
        this.notificacion.mensaje(
          'Pedido',
          '¡Producto agregado al Pedido!',
          'success'
        );
      });
  }
}
