import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { AuthenticationService } from 'src/app/share/authentication.service';
import { NotificacionService } from 'src/app/share/notificacion.service';
import { environment } from 'src/environments/environment';

@Component({
  selector: 'app-user-login',
  templateUrl: './user-login.component.html',
  styleUrls: ['./user-login.component.css'],
})
export class UserLoginComponent implements OnInit {
  formulario: FormGroup;
  makeSubmit: boolean = false;
  infoUsuario: any;
  constructor(
    public fb: FormBuilder,
    private authService: AuthenticationService,
    private notificacion: NotificacionService,
    private router: Router,
    private route: ActivatedRoute
  ) {
    this.reactiveForm();
  }
  //Definir el formulario con sus reglas de validación
  reactiveForm() {
    this.formulario = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
    });
  }

  ngOnInit(): void {
    this.mensajes();
  }

  /*
  mensajes() {
    let register = false;
    //Obtener parámetros de la URL
    this.route.queryParams.subscribe((params) => {
      register = params.register || false;
    });
    if (register) {
      this.notificacion.mensaje(
        'Usuario',
        '¡Registro satisfactorio! Especifique sus credenciales para ingresar',
        'success'
      );
    }
  }
  */

  mensajes() {
    let register = false;
    let auth = false;
    //Obtener parámetros de la URL
    this.route.queryParams.subscribe((params) => {
      register = params.register || false;
      auth = params.auth || false;
    });
    if (register) {
      this.notificacion.mensaje(
        'Usuario',
        '¡Registro satisfactorio! Especifique sus credenciales para ingresar',
        'success'
      );
    }
    if (auth) {
      this.notificacion.mensaje(
        'Usuario',
        'Usuario no autorizado para ingresar al recurso solicitado',
        'warning'
      );
    }
  }

  datosIncompletos() {
    this.notificacion.mensaje(
      'Usuario',
      '¡Por favor complete los datos!',
      'warning'
    );
  }

  onReset() {
    this.formulario.reset();
  }

  submitForm() {
    this.makeSubmit;
    //Validación
    if (this.formulario.invalid) {
      this.datosIncompletos();
      return;
    }
    //console.log(this.formulario.value)
    this.authService
      .loginUser(this.formulario.value)
      .subscribe((respuesta: any) => {
        (this.infoUsuario = respuesta), this.router.navigate(['/']);
      });
  }

  /*Manejar errores de formulario en Angular*/

  public errorHanding = (control: string, error: string) => {
    return (
      this.formulario.controls[control].hasError(error) &&
      this.formulario.controls[control].invalid &&
      (this.makeSubmit || this.formulario.controls[control].touched)
    );
  };
}
