import { Component } from '@angular/core';
import { Usuario } from '../interfaces/Usuario';
import { UsuariosService } from '../Servicios/Usuario/usuarios.service';
import { Router } from '@angular/router';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-perfil',
  templateUrl: './perfil.component.html',
  styleUrls: ['./perfil.component.css']
})
export class PerfilComponent {

  API_ENDPOINT = "http://27.0.174.71/backend/api/index.php/api";

  listaUsuarios: Usuario[] = [];
  usuario: Usuario = { name: "", email: "", telefono: "", password: "", edad: 0, peso: 0, altura: 0, imc: 0, sexo: "m" };

  constructor(private usuariosService: UsuariosService, private router: Router) {
    this.listarUsuarios();
  }

  cerrarSesion(): void{

    Swal.fire({
      title: 'Estas seguro de cerrar sesión?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#009929',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, salir!'

    }).then((result) => {
      if (result.isConfirmed) {
        this.router.navigate(["/login"]);
      }
    });
  }

  listarUsuarios() {
    this.usuariosService.listarUno(localStorage["id_usuario"]).subscribe((data: any) => {

      this.usuario = data;

      if (data.status === 1) {

        this.usuario.id = data.user.id;
        this.usuario.name = data.user.name;
        this.usuario.email = data.user.email;
        this.usuario.telefono = data.user.telefono;
        this.usuario.sexo = data.user.sexo;
        this.usuario.edad = data.user.edad;
        this.usuario.peso = data.user.peso;
        this.usuario.altura = data.user.altura;
        this.usuario.imc = data.user.imc;
        this.usuario.created_at = data.user.created_at;
        this.usuario.updated_at = data.user.updated_at;

      } else {
        alert(data.status.mesagge)
      }

    });
  }


  ngOnInit(): void {

  }
  confirmarBorrado(id: number = 0) {
    Swal.fire({
      title: 'Estas seguro en darte de baja?',
      text: "Esta acción no puede deshacerse!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#009929',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, darme de baja!'

    }).then((result) => {

      if (result.isConfirmed) {

        this.usuariosService.borrar(id).subscribe((data: any) => {

          if (data.status === 1) {

            Swal.fire(
              'Dado de baja!',
              data.message + '. Saliendo  de la aplicación...',
              'success'
            )

            this.router.navigate(["/login"]);
          } else {
            alert(data.message);
          }
        });

      }
    })
  }
}
