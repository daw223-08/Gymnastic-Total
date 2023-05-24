export interface Alimento {
    id?: number;
    nombre: string;
    cantidad: string;
    familia: string;
    horario_ingesta: 'Desayuno' | 'Almuerzo' | 'Merienda' | 'Cena' ;
    dia: string,
    kcal: string,
    id_usuario: string
  }