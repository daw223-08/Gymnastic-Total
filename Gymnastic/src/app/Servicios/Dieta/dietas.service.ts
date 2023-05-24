import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Dieta } from 'src/app/interfaces/Dieta';

@Injectable({
  providedIn: 'root'
})
export class DietasService {

  API_ENDPOINT = "http://27.0.174.71/backend/api/index.php/api";

  constructor(private httpClient: HttpClient) { }

  listar(){
    return this.httpClient.get<Dieta[]>(this.API_ENDPOINT + "/dieta")
  }

  listarPorUsuario(id:any){
    return this.httpClient.get<Dieta>(`${this.API_ENDPOINT}/dieta/listar/${id}`)
  }

  listarUno(id:any){
    return this.httpClient.get<Dieta>(`${this.API_ENDPOINT}/dieta/modificar/${id}`)
  }

  registrar(dieta: Dieta, id_alimentos: string[]) {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const body = {dieta: dieta,id_alimentos: id_alimentos};
    return this.httpClient.post(this.API_ENDPOINT + "/dieta", body, { headers: headers });
  }

  actualizar(dieta: Dieta, id_alimentos: string[], id:any){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    const body = {dieta: dieta,id_alimentos: id_alimentos, id:id};
    return this.httpClient.put(this.API_ENDPOINT+"/dieta/" + id, body, {headers: headers});
  }

  borrar(id:number){
    const headers = new HttpHeaders({'Content-Type':'application/json'});
    return this.httpClient.delete(this.API_ENDPOINT+"/dieta/" + id, {headers: headers});
  }
}
