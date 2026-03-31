import { ISaudacaoConfig } from "./interfaces/saudacao-config";

export function Saudacao({name, describe} : ISaudacaoConfig) {
  return (
    <div style={{backgroundColor: '#f0f0f0', padding: '10px',borderRadius: '8px',marginBottom: '10px'}}>
      <h2 style={{color: '#007bff'}}> Olá, {name}!</h2>
      <p>{describe}</p>
    </div>
  )
}