import { Component } from '@angular/core';
import { Dieta } from '../interfaces/Dieta';
import { AlimentosService } from '../Servicios/Alimento/alimentos.service';
import { DietasService } from '../Servicios/Dieta/dietas.service';
import { ActivatedRoute, Router } from '@angular/router';
import { Alimento } from '../interfaces/Alimento';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-editar-dieta',
  templateUrl: './editar-dieta.component.html',
  styleUrls: ['./editar-dieta.component.css']
})
export class EditarDietaComponent {

  dieta: Dieta = { nombre: "", tipo: "", descripcion: "", id_usuario: localStorage["id_usuario"] };
  dietaModificar: Dieta[] = [];
  id: any;
  alimento: Alimento = { id: 0, nombre: "", cantidad: "", familia: "", horario_ingesta: "Desayuno", dia: "", kcal:"" , id_usuario: localStorage["id_usuario"]};
  listaAlimentos: Alimento[] = [];
  selectAlimento: Alimento[] = [];
  selects: any[] = [];
  comidasSeleccionadas: string[] = [];
  contadorSelectId: number = 1;
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

  constructor(private alimentosService: AlimentosService, private dietasService: DietasService, private activatedRoute: ActivatedRoute, private router: Router) {

    this.alimentosService.listarPorUsuario(localStorage["id_usuario"]).subscribe((data: any) => {
      if (data.status === 1) {
        this.listaAlimentos = data.alimentos;
        this.selectAlimento = this.listaAlimentos.map((alimento: Alimento) => alimento);
      } else {
        alert(data.message);
      }
    });


    this.id = this.activatedRoute.snapshot.params["id"];

    if (this.id) {

      this.dietasService.listarUno(this.id).subscribe((data: any) => {

        this.dietaModificar = data;

        console.log(data);

        if (data.status === 1) {

          this.dieta.nombre = data.dieta.nombre;
          this.dieta.tipo = data.dieta.tipo;
          this.dieta.descripcion = data.dieta.descripcion;

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

  }

  generarSelect(): void {
    this.selects.push({ options: this.selectAlimento });
  }
  
  actualizarDieta() {
    const valoresSeleccionados: string[] = [];
    this.comidasSeleccionadas.forEach((valor: string, index: number) => {

      const selectId: string = 'select-lunes-' + (this.contadorSelectId + index);
      const selectElement: HTMLSelectElement | null = document.getElementById(selectId) as HTMLSelectElement;

      if (selectElement) {
        const valorSeleccionado: string = selectElement.value;
        if (valorSeleccionado !== '') {
          valoresSeleccionados.push(valorSeleccionado);
        }
      }
    });

    this.dietasService.actualizar(this.dieta, valoresSeleccionados, this.id).subscribe((data: any) => {

      console.log(data);

      if (data.status === 1) {

        this.Toast.fire({
          icon: 'success',
          title: data.message
        });

        this.router.navigate(["/mis-dietas"]);

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
}
