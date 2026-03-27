import { Perfil } from "../perfil/perfil";
import { IPainelProps } from "./interfaces/painel-props";

export function Painel( { perfil } : IPainelProps) {
    return (
    <div 
      style={{
        backgroundColor: perfil.role == 'Aluno' ? "#0f1ef5" : "#2d4a4b",
        borderRadius: '15px',
        padding: '25px',
        width: '260px',
        boxShadow: '0 10px 25px rgba(0,0,0,0.1)',
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        fontFamily: 'sans-serif',
        margin: '10px'
      }}
    >
      <div style={{
        width: '70px',
        height: '70px',
        borderRadius: '50%',
        backgroundColor: '#007bff',
        color: 'white',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        fontSize: '24px',
        fontWeight: 'bold',
        marginBottom: '15px'
      }}>
        {perfil.name.charAt(0)}
      </div>

      <Perfil name={perfil.name} role={perfil.role} describe={perfil.describe} />

      <button style={{
        marginTop: '20px',
        width: '100%',
        padding: '12px',
        borderRadius: '10px',
        border: 'none',
        backgroundColor: '#f8f9fa',
        color: '#333',
        fontWeight: '600',
        cursor: 'pointer'
      }}>
        Acessar
      </button>
    </div>
  )
}