import { Component, OnInit } from '@angular/core';
import { CartService, ItemCart } from 'src/app/share/cart.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { Router } from '@angular/router';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
@Component({
  selector: 'app-pedido-index',
  templateUrl: './pedido-index.component.html',
  styleUrls: ['./pedido-index.component.css'],
})
export class PedidoIndexComponent implements OnInit {
  items: ItemCart[] = [];
  total = 0;
  fecha = new Date();
  qtyItems = 0;
  impuesto = 0;
  envio = 0;
  subtotal = 0;
  form: FormGroup;
  provincias: any;
  error: any;
  makeSubmit: boolean = false;
  constructor(
    public fb: FormBuilder,
    private cartService: CartService,
    private noti: NotificacionService,
    private gService: GenericService,
    private router: Router,
    private notificacion: NotificacionService
  ) {
    this.reactiveForm();
  }

  ngOnInit(): void {
    this.items = this.cartService.getItems();
    this.total = this.cartService.getTotal();
    this.impuesto = this.cartService.getImpuesto();
    this.subtotal = this.total - this.impuesto;
    this.cartService.countItems.subscribe((value) => {
      this.qtyItems = value;
    });
  }

  reactiveForm() {
    this.form = this.fb.group({
      cedula_cliente: ['', [Validators.required]],
      nombre_completo_cliente: ['', [Validators.required]],
      telefono_cliente: ['', [Validators.required]],
      tipo_pedido: ['Pasa a retirar', [Validators.required]],
      fecha: ['', [Validators.required]],
      direccion: ['', [Validators.required]],
      provincia_id: ['1', [Validators.required]],
      detalles: this.fb.array([]),
    });
    this.getProvincias();
  }

  getProvincias() {
    return this.gService.list('provincia/').subscribe(
      (data: any) => {
        this.provincias = data;
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

  mostrar() {
    //este es una prueba

  }

  actualizarCantidad(item: any) {
    this.cartService.addToCart(item);
    this.total = this.cartService.getTotal();
    this.impuesto = this.cartService.getImpuesto();
    this.subtotal = this.total - this.impuesto;
    //this.noti.mensaje('Orden', 'Cantidad actualizada', 'success');
  }
  eliminarItem(item: any) {
    this.cartService.removeFromCart(item);
    this.total = this.cartService.getTotal();
    this.impuesto = this.cartService.getImpuesto();
    this.subtotal = this.total - this.impuesto;
    this.noti.mensaje('Orden', 'Producto eliminado del pedido', 'warning');
  }
  ordenar() {

    this.makeSubmit = true;
    if(this.form.value.tipo_pedido=='Pasa a retirar'){
      this.form.value.direccion="Local";
    }

    if (this.qtyItems > 0) {
      this.form.value.detalles = this.cartService.getItems();
      /*let formData = new FormData();
      formData = this.gService.toFormData(this.form.value);
      formData.append('_method', 'POST');*/

      this.gService
        .create('pedido/', this.form.value)
        .subscribe((respuesta: any) => {
          this.noti.mensaje(
            'Orden',
            'Orden registrada satisfactoriamente',
            'success'
          );
          this.cartService.deleteCart();
          this.items = this.cartService.getItems();
          this.total = this.cartService.getTotal();
        });
    } else {
      this.noti.mensaje(
        'Orden',
        'Por favor agregue instrumentos al Pedido',
        'warning'
      );
    }
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.form.controls[control].hasError(error) &&
      this.form.controls[control].invalid &&
      (this.makeSubmit || this.form.controls[control].touched)
    );
  };
}
