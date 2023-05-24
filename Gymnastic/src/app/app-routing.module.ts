import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { EscritorioComponent } from './escritorio/escritorio.component';
import { LoginComponent } from './login/login.component';
import { RegistroComponent } from './registro/registro.component';
import { EditarUsuarioComponent } from './editar-usuario/editar-usuario.component';
import { AuthGuard } from './auth.guard';
import { PerfilComponent } from './perfil/perfil.component';
import { DietasPredisenadasComponent } from './dietas-predisenadas/dietas-predisenadas.component';
import { CrearDietasComponent } from './crear-dietas/crear-dietas.component';
import { GestorAlimentosComponent } from './gestor-alimentos/gestor-alimentos.component';
import { EditarAlimentoComponent } from './editar-alimento/editar-alimento.component';
import { InformacionAdicionalComponent } from './informacion-adicional/informacion-adicional.component';
import { MisDietasComponent } from './mis-dietas/mis-dietas.component';
import { EditarDietaComponent } from './editar-dieta/editar-dieta.component';

const routes: Routes = [
  {
    path: "", component: EscritorioComponent,
    canActivate: [AuthGuard]
  },
  {path: "home", component: EscritorioComponent},
  {path: "login", component: LoginComponent},
  {path: "registro", component: RegistroComponent},
  {path: "perfil", component: PerfilComponent},
  {path: "editar-usuario/:id", component: EditarUsuarioComponent},
  {path: "dietas-predisenadas", component: DietasPredisenadasComponent},
  {path: "crear-dietas", component: CrearDietasComponent},
  {path: "gestor-alimentos", component: GestorAlimentosComponent},
  {path: "editar-alimento/:id", component: EditarAlimentoComponent},
  {path: "informacion-adicional", component: InformacionAdicionalComponent},
  {path: "mis-dietas", component: MisDietasComponent},
  {path: "editar-dieta/:id", component: EditarDietaComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule { }
