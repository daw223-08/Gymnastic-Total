import { Component, OnInit } from '@angular/core';
import { Usuario } from '../interfaces/Usuario';
import { UsuariosService } from '../Servicios/Usuario/usuarios.service';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import Swal from 'sweetalert2'

@Component({
  selector: 'app-editar-usuario',
  templateUrl: './editar-usuario.component.html',
  styleUrls: ['./editar-usuario.component.css']
})
export class EditarUsuarioComponent implements OnInit {

  usuario: Usuario = { name: "", email: "", telefono: "", password: "", edad: 0, peso: 0, altura: 0, imc: 0, sexo: "m" };
  id: any;
  usuarioModififcar: Usuario[] = [];

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

  constructor(private usuariosService: UsuariosService, private activatedRoute: ActivatedRoute, private router: Router) {

    this.id = this.activatedRoute.snapshot.params["id"];

    if (this.id) {

      this.usuariosService.listarUno(this.id).subscribe((data: any) => {

        this.usuarioModififcar = data;      

        console.log(data);
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
          alert(data.mesagge)
        }
      });
    }
  }

  ngOnInit(): void {
  }

  actualizarUsuario() {
    this.usuariosService.actualizar(this.usuario).subscribe((data: any) => {

      if (data.status === 1) {

        this.Toast.fire({
          icon: 'success',
          title: data.message
        });

        console.log(data);
        this.router.navigate(["/perfil"]);

      }else if(data.status === 2){
        
        Swal.fire({
          icon: 'error',
          title: 'Ups! Algo salió mal',
          text: data.message,
          confirmButtonColor: '#003400',
        })
        
      }else {

        Swal.fire({
          icon: 'error',
          title: 'Ups! Algo salió mal',
          text: "No se pudo actualizar el usuario",
          confirmButtonColor: '#003400',
        })
      }
    });
  }
}
