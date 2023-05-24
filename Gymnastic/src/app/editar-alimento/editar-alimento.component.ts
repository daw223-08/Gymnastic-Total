import { Component } from '@angular/core';
import { Alimento } from '../interfaces/Alimento';
import { AlimentosService } from '../Servicios/Alimento/alimentos.service';
import { ActivatedRoute, Router } from '@angular/router';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-editar-alimento',
  templateUrl: './editar-alimento.component.html',
  styleUrls: ['./editar-alimento.component.css']
})
export class EditarAlimentoComponent {

  alimento: Alimento = { nombre: "", cantidad: "", familia: "", horario_ingesta: "Desayuno", dia: "", kcal:"", id_usuario: localStorage["id_usuario"] };
  id: any;
  alimentoModificar: Alimento[] = [];

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

    this.id = this.activatedRoute.snapshot.params["id"];

    if (this.id) {

      this.alimentosService.listarUno(this.id).subscribe((data: any) => {

        this.alimentoModificar = data;      

        console.log(data);

        if (data.status === 1) {

          this.alimento.nombre = data.alimento.nombre;
          this.alimento.cantidad = data.alimento.cantidad;
          this.alimento.familia = data.alimento.familia;
          this.alimento.horario_ingesta = data.alimento.horario_ingesta;
          this.alimento.dia = data.alimento.dia;
          this.alimento.id_usuario = data.alimento.id_usuario;

        } else {
          alert(data.mesagge)
        }
      });
    }
  }

  ngOnInit(): void {
  }

  actualizarAlimento() {
    this.alimentosService.actualizar(this.alimento, this.id).subscribe((data: any) => {

      console.log(data);

      if (data.status === 1) {
        this.Toast.fire({
          icon: 'success',
          title: data.message
        });
        this.router.navigate(["/gestor-alimentos"]);

      } else if(data.status === 2){

        Swal.fire({
          icon: 'error',
          title: 'Ups! Algo salió mal',
          text: data.message,
          confirmButtonColor: '#003400',
        })

      }
      else {
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
