import { formatDate } from '@angular/common';
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
  selector: 'app-personal-update',
  templateUrl: './personal-update.component.html',
  styleUrls: ['./personal-update.component.css'],
})
export class PersonalUpdateComponent implements OnInit {
  personal: any;
  imageURL: string;
  vehiculos: any;
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
    this.getPersonal(id);
  }

  getPersonal(id: number) {
    this.gService.get('personal', id).subscribe((respuesta: any) => {
      this.personal = respuesta;
      //Obtenida la información del videojuego
      //se construye el formulario
      this.reactiveForm();
    });
  }

  reactiveForm() {
    this.getvehiculos();

    //Si hay información del videojuego
    if (this.personal) {
      //Cargar la información del videojuego
      //en los controles que conforman el formulario
      this.formUpdate = this.fb.group({
        id: [this.personal.id, [Validators.required]],
        nombre: [this.personal.nombre, [Validators.required]],
        apellido: [this.personal.apellido, [Validators.required]],
        correo: [this.personal.correo, [Validators.required]],
        telefono: [this.personal.telefono, [Validators.required]],
        estado: [this.personal.estado, [Validators.required]],
        vehiculo_id: [this.personal.vehiculo_id, [Validators.required]],
      });
    }
  }

  getvehiculos() {
    return this.gService.list('vehiculo/').subscribe(
      (data: any) => {
        this.vehiculos = data;
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

  submitForm() {
    this.makeSubmit = true;

    if (this.formUpdate.value.estado == true) {
      this.formUpdate.value.estado = 1;
    } else {
      this.formUpdate.value.estado = 0;
    }
    let formData = new FormData();
    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('personal', formData)
      .subscribe((respuesta: any) => {
        this.personal = respuesta;
        this.router.navigate(['/personal/all'], {
          queryParams: { update: 'true' },
        });
        this.notificacion.mensaje(
          'Usuario:',
          'El la actualización se realizó correctamente',
          'success'
        );
      });
  }
  onReset() {
    this.formUpdate.reset();
  }
  onBack() {
    this.router.navigate(['/personal/all']);
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
