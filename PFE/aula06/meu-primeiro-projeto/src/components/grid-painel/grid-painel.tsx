import { Painel } from "./components/painel/painel";
import { IGridPainelProps } from "./interfaces/grid-painel-props";

export function GridPainel({profiles} : IGridPainelProps) {
    return (
    <div style={{
      display: 'grid',
      gridTemplateColumns: 'repeat(3, 1fr)',
      maxWidth: '900px',
      margin: '0 auto'
    }}>
      {profiles.map((profile, index) => (
        <Painel key={index} perfil={profile.perfil} />
      ))}
    </div>
  )
}