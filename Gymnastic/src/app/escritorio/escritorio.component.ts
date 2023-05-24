import { Component, OnInit } from '@angular/core';
import { UsuariosService } from '../Servicios/Usuario/usuarios.service';
import { Usuario } from '../interfaces/Usuario';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-escritorio',
  templateUrl: './escritorio.component.html',
  styleUrls: ['./escritorio.component.css']
})
export class EscritorioComponent implements OnInit{

    usuarios: Usuario[] = [];
    usuario: Usuario = {name: "", email: "", telefono: "", password: "", edad: 0, peso: 0, altura: 0, imc: 0, sexo: "m"};
    
    constructor(private usuariosService: UsuariosService, private activatedRoute: ActivatedRoute, private router: Router){
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

    listarUsuarios(){
      this.usuariosService.listar().subscribe((data: Usuario[]) => {
      this.usuarios = data
      },(error: any) => {
        console.log(error);
        alert("Error al listar el usuario");
      });
    }


    ngOnInit(): void {
      
    }

    borrar(id:number = 0){
      if (id === 0) {
        console.log("No se ha proporcionado un ID válido");
        return;
      }
      this.usuariosService.borrar(id).subscribe(() => {
        alert("Usuario borrado de la base de datos");
        this.listarUsuarios();
      },(error: any) => {
        console.log(error);
      });
    }
}
