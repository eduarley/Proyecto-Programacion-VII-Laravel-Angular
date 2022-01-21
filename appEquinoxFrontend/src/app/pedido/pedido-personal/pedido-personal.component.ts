import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
} from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-pedido-personal',
  templateUrl: './pedido-personal.component.html',
  styleUrls: ['./pedido-personal.component.css'],
})
export class PedidoPersonalComponent implements OnInit {
  pedido: any;
  personals: any;
  error: any;
  makeSubmit: boolean = false;
  formUpdate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    public fb: FormBuilder,
    private router: Router,
    private route: ActivatedRoute,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    const id = +this.route.snapshot.paramMap.get('id');
    this.getPedido(id);
  }

  getPedido(id: number) {
    this.gService.get('pedido', id).subscribe((respuesta: any) => {
      this.pedido = respuesta;
      //Obtenida la información del videojuego
      //se construye el formulario
      this.reactiveForm();
    });
  }

  reactiveForm() {
    this.getpersonals();

    //Si hay información del videojuego
    if (this.pedido) {
      //Cargar la información del videojuego
      //en los controles que conforman el formulario
      this.formUpdate = this.fb.group({
        id: [this.pedido.id, [Validators.required]],
        personal_id: [this.pedido.personal_id, [Validators.required]],
      });
    }
  }

  getpersonals() {
    return this.gService.list('personal/').subscribe(
      (data: any) => {
        this.personals = data;
        console.log(this.personals);
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

  submitForm() {
    this.makeSubmit = true;

    //if (this.formUpdate.value.estado == true) {
    //this.formUpdate.value.estado = 1;
    //} else {
    //this.formUpdate.value.estado = 0;
    //}
    let formData = new FormData();
    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('pedido/updatePersonal', formData)
      .subscribe((respuesta: any) => {
        this.pedido = respuesta;
        this.router.navigate(['/pedido/all'], {
          queryParams: { update: 'true' },
        });
        this.notificacion.mensaje(
          'Usuario:',
          'Se asignó el personal de entrega correctamente',
          'success'
        );
      });
  }
  onReset() {
    this.formUpdate.reset();
  }
  onBack() {
    this.router.navigate(['/pedido/all']);
  }
  public errorHandling = (control: string, error: string) => {
    return (
      this.formUpdate.controls[control].hasError(error) &&
      this.formUpdate.controls[control].invalid &&
      (this.makeSubmit || this.formUpdate.controls[control].touched)
    );
  };

  ngOnInit(): void {}
}
