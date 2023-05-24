import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { EscritorioComponent } from './escritorio/escritorio.component';
import { LoginComponent } from './login/login.component';
import { HttpClientModule } from '@angular/common/http';
import { RegistroComponent } from './registro/registro.component';
import { FormsModule } from '@angular/forms';
import { EditarUsuarioComponent } from './editar-usuario/editar-usuario.component';
import { ToastrModule } from 'ngx-toastr';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { PerfilComponent } from './perfil/perfil.component';
import { DietasPredisenadasComponent } from './dietas-predisenadas/dietas-predisenadas.component';
import { CrearDietasComponent } from './crear-dietas/crear-dietas.component';
import { GestorAlimentosComponent } from './gestor-alimentos/gestor-alimentos.component';
import { NgxPaginationModule } from 'ngx-pagination';
import { EditarAlimentoComponent } from './editar-alimento/editar-alimento.component';
import { InformacionAdicionalComponent } from './informacion-adicional/informacion-adicional.component';
import { MisDietasComponent } from './mis-dietas/mis-dietas.component';
import { EditarDietaComponent } from './editar-dieta/editar-dieta.component';

@NgModule({
  declarations: [
    AppComponent,
    EscritorioComponent,
    LoginComponent,
    RegistroComponent,
    EditarUsuarioComponent,
    PerfilComponent,
    DietasPredisenadasComponent,
    CrearDietasComponent,
    GestorAlimentosComponent,
    EditarAlimentoComponent,
    InformacionAdicionalComponent,
    MisDietasComponent,
    EditarDietaComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    BrowserAnimationsModule,
    NgxPaginationModule,
    ToastrModule.forRoot()
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
