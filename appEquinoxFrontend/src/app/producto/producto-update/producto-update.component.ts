import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, FormArray, FormControl } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subject } from 'rxjs';
import { GenericService } from 'src/app/share/generic.service';
import { NotificacionService } from 'src/app/share/notificacion.service';

@Component({
  selector: 'app-producto-update',
  templateUrl: './producto-update.component.html',
  styleUrls: ['./producto-update.component.css'],
})
export class ProductoUpdateComponent implements OnInit {
  producto: any;
  imageURL: string;
  categoriasList: any;
  marcas: any;
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
    this.getProducto(id);
  }



  getProducto(id: number) {
    this.gService.get('producto', id).subscribe((respuesta: any) => {
      this.producto = respuesta;
      //Obtenida la información del videojuego
      //se construye el formulario
      this.reactiveForm();
    });
  }
   reactiveForm() {
    this.formUpdate = this.fb.group({
      id: [this.producto.id, [Validators.required]],
      nombre: [this.producto.nombre, [Validators.required,Validators.minLength(5)]],
      descripcion: [this.producto.descripcion, [Validators.required,Validators.minLength(10)]],
      precio: [this.producto.precio, [Validators.required, Validators.pattern('[0-9]+')]],
      estado: [this.producto.estado, [Validators.required]],
      categorias: this.fb.array([]),
      categoria_id: this.fb.array([]),
      marca_id: [this.producto.marca_id, [Validators.required]],
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
    return this.formUpdate.get('categorias') as FormArray;
  }
  get categoria_id(): FormArray {
    return this.formUpdate.get('categoria_id') as FormArray;
  }

onCheckChange(idCheck, event) {
    /* seleccionado */
    if (event.target.checked) {
      // agregar un nuevo control en el array de controles de los identificadores
      (this.formUpdate.controls.categoria_id as FormArray).push(
        new FormControl(event.target.value)
      );
    } else {
      /* Deseleccionar*/
      // Buscar el elemento que se le quito la selección
      let i = 0;

      this.categoria_id.controls.forEach((ctrl: FormControl) => {
        if (idCheck == ctrl.value) {
          // Quitar el elemento deseleccionado del array
          (this.formUpdate.controls.categoria_id as FormArray).removeAt(i);
          return;
        }

        i++;
      });
    }
  }


  private checkboxgeneros() {
    //Recorrer la lista de generos y especificar si esta seleccionado
    this.categoriasList.forEach((o) => {
      let selected = false;
      if (this.producto.categorias.find((x) => x.id == o.id)) {
        selected = true;
      }
      const control = new FormControl(selected);
      (this.formUpdate.controls.categorias as FormArray).push(control);
      if (selected) {
        //Agregar al array de id seleccionados
        (this.formUpdate.controls.categoria_id as FormArray).push(
          new FormControl(o.id)
        );
      }
    });
  }


  submitForm() {
    this.makeSubmit = true;
    let formData = new FormData();

    formData = this.gService.toFormData(this.formUpdate.value);
    formData.append('_method', 'PATCH');
    this.gService
      .update_formdata('producto', formData)
      .subscribe((respuesta: any) => {
        this.producto = respuesta;
        this.router.navigate(['/producto/all'], {
          queryParams: { register: 'true' },
        });
        this.notificacion.mensaje('Usuario:','El registro se actualizó correctamente','success');
      });
  }
  onReset() {
    this.formUpdate.reset();
  }
  onBack() {
    this.router.navigate(['/producto/all']);
  }

  public errorHandling = (control: string, error: string) => {
    return (
      this.formUpdate.controls[control].hasError(error) &&
      this.formUpdate.controls[control].invalid &&
      (this.makeSubmit || this.formUpdate.controls[control].touched)
    );
  };
}
