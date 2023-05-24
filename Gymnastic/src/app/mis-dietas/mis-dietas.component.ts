import { Component } from '@angular/core';
import { Dieta } from '../interfaces/Dieta';
import { DietasService } from '../Servicios/Dieta/dietas.service';
import Swal from 'sweetalert2';
import { Router } from '@angular/router';

@Component({
  selector: 'app-mis-dietas',
  templateUrl: './mis-dietas.component.html',
  styleUrls: ['./mis-dietas.component.css']
})
export class MisDietasComponent {

  dietas: Dieta[] = [];
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

  constructor(private dietasService: DietasService, private router: Router){
    this.listarDietas();
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

  listarDietas() {
    this.dietasService.listarPorUsuario(localStorage["id_usuario"]).subscribe((data: any) => {
      console.log(data);
  
      if (data.status === 1) {

        this.dietas = data.dietas;

      } else {

        Swal.fire({
          icon: 'info',
          title: 'Vaya... ' + data.message,
          text: 'Crea una dieta y podras visualizar aqui sus detalles',
          confirmButtonText: 'Empezar a crear',
          confirmButtonColor: '#003400',
        })
        this.router.navigate(["/crear-dietas"]);
      }
    });
  }

  confirmarBorrado(id: any, nombre:string) {

    Swal.fire({

      title: 'Estas seguro de borrar la dieta ' + nombre + '?',
      text: "Esta acción no puede deshacerse!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#009929',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrala!'

    }).then((result) => {

      if (result.isConfirmed) {

        this.dietasService.borrar(id).subscribe((data: any) => {

          if (data.status === 1) {

            this.Toast.fire({
              icon: 'success',
              title: data.message
            });

            this.listarDietas();
            //BUG AL BORRAR ULTIMA DIETA
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
    })
  }
}
