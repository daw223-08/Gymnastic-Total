export interface Usuario{
    id?: number;
    name: string;
    email: string;
    telefono: string;
    password: string;
    edad: number;
    peso: number;
    altura: number;
    imc: number;
    sexo: 'm' | 'f';
    created_at?: string;
    updated_at?: string;
}