import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Usuario } from 'src/app/interfaces/Usuario';

@Injectable({
  providedIn: 'root'
})
export class UsuariosService {

  API_ENDPOINT = "http://27.0.174.71/backend/api/index.php/api";

  constructor(private httpClient: HttpClient) { }

  listar(){
    return this.httpClient.get<Usuario[]>(this.API_ENDPOINT + "/user")
  }

  listarUno(id:any){
    return this.httpClient.get<Usuario>(`${this.API_ENDPOINT}/user/perfil/${id}`)
  }

  login(usuario:Usuario){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.post<Usuario[]>(this.API_ENDPOINT + "/user/login", usuario, {headers: headers})
  }
  
  registrar(usuario:Usuario){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.post(this.API_ENDPOINT+"/user", usuario, {headers: headers});
  }

  actualizar(usuario:Usuario){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.put(this.API_ENDPOINT+"/user/" + usuario.id, usuario, {headers: headers});
  }

  borrar(id:number){
    return this.httpClient.delete<Usuario[]>(this.API_ENDPOINT + "/user/" + id)
  }

}
