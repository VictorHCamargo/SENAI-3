import { IHeaderConfig } from "./interfaces/header-config";

export function Header(props : IHeaderConfig) {
  return (
    <header style={{ background: '#646cff', padding: '20px', color: 'white',
    textAlign: 'center' }}>
      <h1>{props.titulo}</h1>
    </header>
  );
}
