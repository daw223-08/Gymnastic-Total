import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-dietas-predisenadas',
  templateUrl: './dietas-predisenadas.component.html',
  styleUrls: ['./dietas-predisenadas.component.css']
})
export class DietasPredisenadasComponent {

  constructor( private activatedRoute: ActivatedRoute, private router: Router) {}

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

}
