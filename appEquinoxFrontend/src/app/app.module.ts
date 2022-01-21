import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { CoreModule } from './core/core.module';
import { ShareModule } from './share/share.module';
import { HomeModule } from './home/home.module';
import { UserModule } from './user/user.module';
import { PedidoModule } from './pedido/pedido.module';
import { PersonalModule } from './personal/personal.module';
import { ProductoModule } from './producto/producto.module';
import { HttpErrorInterceptorService } from './share/http-error-interceptor.service';
import { CustomDatePipe } from './pipes/custom-date.pipe';
import { FacturaModule } from './factura/factura.module';

@NgModule({
  declarations: [AppComponent, CustomDatePipe],
  imports: [
    BrowserModule,
    HttpClientModule,
    CoreModule,
    ShareModule,
    HomeModule,
    UserModule,
    PedidoModule,
    PersonalModule,
    ProductoModule,
    FacturaModule,
    AppRoutingModule,
  ],

  providers: [
    {
      provide: HTTP_INTERCEPTORS,
      useClass: HttpErrorInterceptorService,
      multi: true,
    },
  ],
  bootstrap: [AppComponent],
})
export class AppModule {}
