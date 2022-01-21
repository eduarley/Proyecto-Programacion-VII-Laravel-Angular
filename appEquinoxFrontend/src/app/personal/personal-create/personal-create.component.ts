import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { Subject } from 'rxjs';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-personal-create',
  templateUrl: './personal-create.component.html',
  styleUrls: ['./personal-create.component.css'],
})
export class PersonalCreateComponent implements OnInit {
  personal: any;
  imageURL: string;
  vehiculos: any;
  error: any;
  makeSubmit: boolean = false;
  formCreate: FormGroup;
  destroy$: Subject<boolean> = new Subject<boolean>();
  constructor(
    public fb: FormBuilder,
    private router: Router,
    private gService: GenericService,
    private notificacion: NotificacionService
  ) {
    this.reactiveForm();
  }

  reactiveForm() {
    this.formCreate = this.fb.group({
      nombre: ['', [Validators.required]],
      apellido: ['', [Validators.required]],
      correo: ['', [Validators.required]],
      telefono: ['', [Validators.required]],
      estado: ['1', [Validators.required]],
      vehiculo_id: ['', [Validators.required]],
    });
    this.getvehiculos();
  }

  ngOnInit(): void {}
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
    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService
      .create_formdata('personal/', formData)
      .subscribe((respuesta: any) => {
        this.personal = respuesta;
        this.router.navigate(['/personal/all'], {
          queryParams: { register: 'true' },
        });
        this.notificacion.mensaje('Usuario:','El registro se realizó correctamente','success');
      });
    console.log(this.personal);
  }
  onReset() {
    this.formCreate.reset();
  }
  onBack() {
    this.router.navigate(['/personal/all']);
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };
}
