import { Component, OnInit } from '@angular/core';
import {
  Validators,
  FormGroup,
  FormBuilder,
  FormArray,
  FormControl,
} from '@angular/forms';
import { Subject } from 'rxjs';
import { Router } from '@angular/router';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-producto-create',
  templateUrl: './producto-create.component.html',
  styleUrls: ['./producto-create.component.css'],
})
export class ProductoCreateComponent implements OnInit {
  producto: any;
  imageURL: string;
  categoriasList: any;
  marcas: any;
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
      nombre: ['', [Validators.required, Validators.minLength(5)]],
      descripcion: ['', [Validators.required, Validators.minLength(10)]],
      precio: ['', [Validators.required, Validators.pattern('[0-9]+')]],
      estado: ['1', [Validators.required]],
      categorias: this.fb.array([]),
      categoria_id: this.fb.array([]),
      marca_id: ['', [Validators.required]],
    });
    this.getcategorias();
    this.getMarcas();
  }

  ngOnInit(): void {}


  getcategorias() {
    return this.gService.list('categoria/').subscribe(
      (respuesta: any) => {
        (this.categoriasList = respuesta), this.checkboxgeneros();
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }
  getMarcas() {
    return this.gService.list('marca/').subscribe(
      (data: any) => {
        this.marcas = data;
      },
      (error) => {
        this.error = error;
        this.notificacion.msjValidacion(this.error);
      }
    );
  }

  get categorias(): FormArray {
    return this.formCreate.get('categorias') as FormArray;
  }
  get categoria_id(): FormArray {
    return this.formCreate.get('categoria_id') as FormArray;
  }
  private checkboxgeneros() {
    this.categoriasList.forEach(() => {
      const control = new FormControl(); // primer parámetro valor a asignar
      (this.formCreate.controls.categorias as FormArray).push(control);
    });
  }

  onCheckChange(idCheck, event) {
    /* seleccionado */
    if (event.target.checked) {
      // agregar un nuevo control en el array de controles de los identificadores
      (this.formCreate.controls.categoria_id as FormArray).push(
        new FormControl(event.target.value)
      );
    } else {
      /* Deseleccionar*/
      // Buscar el elemento que se le quito la selección
      let i = 0;

      this.categoria_id.controls.forEach((ctrl: FormControl) => {
        if (idCheck == ctrl.value) {
          // Quitar el elemento deseleccionado del array
          (this.formCreate.controls.categoria_id as FormArray).removeAt(i);
          return;
        }

        i++;
      });
    }
  }

  submitForm() {
    this.makeSubmit = true;
    let formData = new FormData();
    formData = this.gService.toFormData(this.formCreate.value);
    formData.append('_method', 'POST');
    this.gService
      .create_formdata('producto', formData)
      .subscribe((respuesta: any) => {
        this.producto = respuesta;
        this.router.navigate(['/producto/all'], {
          queryParams: { register: 'true' },
        });
        this.notificacion.mensaje('Usuario:','El registro se realizó correctamente','success');
      } );
  }
  onReset() {
    this.formCreate.reset();
  }
  onBack() {
    this.router.navigate(['/producto/all']);
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formCreate.controls[control].hasError(error) &&
      this.formCreate.controls[control].invalid &&
      (this.makeSubmit || this.formCreate.controls[control].touched)
    );
  };
}
