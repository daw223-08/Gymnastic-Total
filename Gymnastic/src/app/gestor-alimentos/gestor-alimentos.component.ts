import { Component } from '@angular/core';
import { Alimento } from '../interfaces/Alimento';
import { AlimentosService } from '../Servicios/Alimento/alimentos.service';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-gestor-alimentos',
  templateUrl: './gestor-alimentos.component.html',
  styleUrls: ['./gestor-alimentos.component.css']
})
export class GestorAlimentosComponent {

  alimentos: Alimento[] = [];
  alimento: Alimento = { nombre: "", cantidad: "", familia: "", horario_ingesta: "Desayuno", dia: "", kcal:"", id_usuario: localStorage["id_usuario"] };

  page!: number;

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

  constructor(private alimentosService: AlimentosService, private activatedRoute: ActivatedRoute, private router: Router) {
    this.listarAlimentos();
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

  listarAlimentos() {
    this.alimentosService.listarPorUsuario(localStorage["id_usuario"]).subscribe((data: any) => {

      if (data.status === 1) {

        this.alimentos = data.alimentos;

      } else {

        Swal.fire({
          icon: 'error',
          title: 'Ups! Algo salió mal',
          text: data.message,
          confirmButtonColor: '#003400',
        })
      }
    });
  }

  registrarAlimento() {

    this.alimentosService.registrar(this.alimento).subscribe((data: any) => {

      if (data.status === 1) {

        this.Toast.fire({
          icon: 'success',
          title: data.message
        });

        this.listarAlimentos();

      } else {

        Swal.fire({
          icon: 'error',
          title: 'Ups! Algo salió mal',
          text: data.message,
          confirmButtonColor: '#003400',
        })
      }
    });
  }

  confirmarBorrado(id: any, nombre:string) {
    Swal.fire({
      title: 'Estas seguro de borrar ' + nombre + '?',
      text: "Esta acción no puede deshacerse!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#009929',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borralo!'

    }).then((result) => {

      if (result.isConfirmed) {

        this.alimentosService.borrar(id).subscribe((data: any) => {

          if (data.status === 1) {

            Swal.fire({
              icon: 'success',
              title: 'Alimento eliminado!',
              text: data.message,
              confirmButtonColor: '#003400',
              footer: '¡Se ha eliminado el alimento de las dietas al que pertenecía!'
            })

            this.listarAlimentos();

          } else {

            Swal.fire({
              icon: 'error',
              title: 'Ups! Algo salió mal',
              text: "No se pudo eliminar el alimento",
              confirmButtonColor: '#003400',
            })
          }
        });
      }
    });
  }
}
