import { Component } from '@angular/core';
import { Usuario } from '../interfaces/Usuario';
import { UsuariosService } from '../Servicios/Usuario/usuarios.service';
import {Router} from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import Swal from 'sweetalert2'

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {

  email: string | undefined;
  contrasena: string | undefined;
  data: any;
  token: any;

  usuario: Usuario = {name: "", email: "", telefono: "", password: "", edad: 0, peso: 0, altura: 0, imc: 0, sexo: "m"};


  Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 4000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  constructor(public usuariosService:UsuariosService, private router:Router, private toast: ToastrService){}

  login(){
    this.usuariosService.login(this.usuario).subscribe((res) => {
      this.data = res

      if(this.data.status === 1){
        this.token = this.data.data.token;
        localStorage.setItem("token", this.token);
        localStorage.setItem("email", this.data.email);
        localStorage.setItem("id_usuario", this.data.id_usuario);
        this.router.navigate(["/"]);
        this.Toast.fire({
          icon: 'success',
          title: 'Has iniciado sesión con éxito. Bienvenido!'
        })

      }else if(this.data.status === 0){

        Swal.fire({
          icon: 'error',
          title: 'Vaya, algo salió mal',
          text: this.data.mesagge,
          confirmButtonColor: '#003400',
        })
      }
    });
  }

}
