import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { AuthenticationService } from 'src/app/share/authentication.service';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-factura-create',
  templateUrl: './factura-create.component.html',
  styleUrls: ['./factura-create.component.css']
})
export class FacturaCreateComponent implements OnInit {
  fecha = new Date();
  pedidos: any;
  currentUser: any;
  factura: any;
  error: any;
  makeSubmit: boolean = false;
  formCreate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(

    public fb: FormBuilder,
    private router: Router,
    private gService: GenericService,
    private notificacion: NotificacionService,
    private authService: AuthenticationService
  ) {
    

   }

  ngOnInit(): void {
    this.authService.currentUser.subscribe((x) => (this.currentUser = x));
    this.reactiveForm();
  }

  reactiveForm() {
    this.formCreate = this.fb.group({
      pedido_id: ['', [Validators.required]],
      user_id: [this.currentUser.user.id, [Validators.required]],
      //fecha: [this.date.toLocaleString(), [Validators.required]],
      total: ['', [Validators.required]],
    });
    this.getPedidos();
  }

  getPedidos(){
    //cambiar a que este jale solo los listos para facturar
      return this.gService.list('pedido/alllisto').subscribe(
      (data: any) => {
        this.pedidos = data;
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

  submitForm() {
    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService
      .create('factura/', formData)
      .subscribe((respuesta: any) => {
        this.factura = respuesta;
        this.router.navigate(['/factura/all'], {
          queryParams: { register: 'true' },
        });
        this.notificacion.mensaje('Usuario:','El registro se realizó correctamente','success');
      });
  }
  onReset() {
    this.formCreate.reset();
  }
  onBack() {
    this.router.navigate(['/factura/all']);
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };
}
