import { Saudacao } from "../saudacao/saudacao";
import { IPerfilConfig } from "./interfaces/perfil-config";

export function Perfil({name,role,describe} : IPerfilConfig) {
    return (
    <div style={{ textAlign: 'center' }}>
      <h3 style={{ margin: '0 0 5px 0', color: '#1a1a1a', fontSize: '18px' }}>
        {name}
      </h3>
      <p style={{ margin: 0, color: '#6c757d', fontSize: '14px' }}>
        {role}
      </p>
      <Saudacao name={name} describe={describe}/>
    </div>
  )
}