import { Alimento } from "./Alimento";

export interface Dieta {
    id?: number;
    tipo?: string;
    nombre: string;
    descripcion: string;
    id_usuario: number;
    alimentos?: Alimento[];
  }