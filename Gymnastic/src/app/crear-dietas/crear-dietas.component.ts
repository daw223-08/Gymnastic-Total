import { Component } from '@angular/core';
import { Alimento } from '../interfaces/Alimento';
import { Dieta } from '../interfaces/Dieta';
import { AlimentosService } from '../Servicios/Alimento/alimentos.service';
import { DietasService } from '../Servicios/Dieta/dietas.service';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-crear-dietas',
  templateUrl: './crear-dietas.component.html',
  styleUrls: ['./crear-dietas.component.css']
})
export class CrearDietasComponent {
  
  listaAlimentos: Alimento[] = [];

  alimento: Alimento = { id: 0, nombre: "", cantidad: "", familia: "", horario_ingesta: "Desayuno", dia: "", kcal:"", id_usuario: "" };
  dieta: Dieta = { nombre: "", tipo: "", descripcion: "", id_usuario: localStorage["id_usuario"]};


  selectAlimento: Alimento[] = [];
  selectAlimentoId: number[] = [];
  selects: any[] = [];
  mostrarBotonGenerar: boolean = false;
  contadorSelectId: number = 1;
  comidasSeleccionadas: string[] = [];

  constructor(private alimentosService: AlimentosService, private dietasService: DietasService, private activatedRoute: ActivatedRoute, private router: Router) {

    this.alimentosService.listarPorUsuario(localStorage["id_usuario"]).subscribe((data: any) => {
      if (data.status === 1) {
        this.listaAlimentos = data.alimentos;
        this.selectAlimento = this.listaAlimentos.map((alimento: Alimento) => alimento);
      } else {
        alert(data.message);
      }
    });
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

  generarSelect(): void {
    this.selects.push({ options: this.selectAlimento });
  }

  guardarDieta(): void {
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

    this.dietasService.registrar(this.dieta, valoresSeleccionados).subscribe((data: any) => {

      console.log(data);

      if (data.status === 1) {

        Swal.fire({
          icon: 'success',
          title: 'Has creado una dieta!',
          text: data.message,
          confirmButtonColor: '#003400',
          footer: 'Puedes visualizarla en &nbsp;<a href="http://27.0.174.71/backend/mis-dietas">Mis Dietas</a>'
        })

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
