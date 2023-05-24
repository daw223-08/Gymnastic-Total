import { Component, OnInit } from '@angular/core';
import { Usuario } from '../interfaces/Usuario';
import { UsuariosService } from '../Servicios/Usuario/usuarios.service';
import { Router } from '@angular/router';
import Swal from 'sweetalert2'

@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})


export class RegistroComponent implements OnInit {

  usuario: Usuario = { name: "", email: "", telefono: "", password: "", edad: 0, peso: 0, altura: 0, imc: 0, sexo: "m" };

  validacion: any;

  constructor(private usuariosService: UsuariosService, private router: Router) {
  }

  ngOnInit(): void {
  }

  registrarUsuario() {
    if (this.usuario.password !== this.validacion) {

      mostrarPopup();

    } else {

      this.usuariosService.registrar(this.usuario).subscribe((data: any) => {

        console.log(data);
  
        if(data.status === 2){
  
          Swal.fire({
            icon: 'error',
            title: 'Ups! Algo salió mal',
            text: data.message,
            confirmButtonColor: '#003400',
          })
  
        }else if (data.status === 0) {
  
          Swal.fire({
            icon: 'info',
            title: 'Ups! Ya tienes cuenta?',
            text: data.message,
            confirmButtonColor: '#003400',
          })
  
        } else {
          Swal.fire({
            icon: 'success',
            title: 'Te has dado de alta!',
            text: data.message,
            confirmButtonColor: '#003400',
            footer: 'Ahora puedes iniciar sesión y disfrutar de Gymnastic!'
          })
          this.router.navigate(["/login"]);
        }
      });
      
    }

    function mostrarPopup(){
      Swal.fire({
        icon: 'error',
        title: 'Ups! La contraseñas no coinciden',
        text: 'Revisa tus credenciales',
        confirmButtonColor: '#003400',
      })
    }
  }
}
