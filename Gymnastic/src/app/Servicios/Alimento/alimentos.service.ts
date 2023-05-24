import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Alimento } from 'src/app/interfaces/Alimento';

@Injectable({
  providedIn: 'root'
})


export class AlimentosService {

  API_ENDPOINT = "http://27.0.174.71/backend/api/index.php/api";

  constructor(private httpClient: HttpClient) { }
  
  listar(){
    return this.httpClient.get<Alimento[]>(this.API_ENDPOINT + "/alimento")
  }

  listarUno(id:any){
    return this.httpClient.get<Alimento>(`${this.API_ENDPOINT}/alimento/modificar/${id}`)
  }

  listarPorUsuario(id:any){
    return this.httpClient.get<Alimento>(`${this.API_ENDPOINT}/alimento/listar/${id}`)
  }

  registrar(alimento:Alimento){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.post(this.API_ENDPOINT+"/alimento", alimento, {headers: headers});
  }

  actualizar(alimento:Alimento, id:any){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.put(this.API_ENDPOINT+"/alimento/" + id, alimento, {headers: headers});
  }

  borrar(id:number){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.delete(this.API_ENDPOINT+"/alimento/" + id, {headers: headers});
  }

}
