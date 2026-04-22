import React, { useState, useEffect } from 'react';
import { ContadorCliques } from './components/utils/contador-cliques/contador-cliques';
import { Header } from './components/header/header';
import { InputUsuario } from './components/utils/input-usuario/input-usuario';
import { CardSaudacao } from './components/card-saudacao/card-saudacao';
import { ThemeToggle } from './components/utils/theme-toggle/theme-toggle';
import { ListaRecursos } from './components/utils/lista-recursos/lista-recursos';
import { useTheme } from './hook/use-theme';

export default function App() {
  const [nome, setNome] = useState('');
  const [cliques, setCliques] = useState(0);
  const { dark } = useTheme();

  const recursosReact = ['Vite', 'Function Components', 'Named Exports',
  'useState', 'useEffect', 'Props'];

  useEffect(function() {
    document.title = "Cliques: " + cliques;
  }, [cliques]);

  const containerStyle : React.CSSProperties = {
    fontFamily: 'Inter, system-ui, Arial, sans-serif',
    textAlign: 'center',
    minHeight: '100vh',
    backgroundColor: dark ? '#242424' : '#ffffff',
    color: dark ? '#ffffff' : '#213547',
    transition: '0.25s'
  };

  return (
  <div style={containerStyle}>
    <Header titulo="Exercício React com Functions" />

    <main style={{ padding: '20px', maxWidth: '800px', margin: '0 auto' }}>
      <InputUsuario nome={nome} setNome={setNome} />

      <CardSaudacao nome={nome} temaEscuro={dark} />

      <div style={{ display: 'flex', justifyContent: 'center', gap: '20px',
        alignItems: 'center', flexWrap: 'wrap' }}>
        <ContadorCliques cliques={cliques} setCliques={setCliques} />
        <ThemeToggle />
      </div>

      <div style={{ marginTop: '30px' }}>
        <h4>Conceitos chave identificados:</h4>
        <ListaRecursos itens={recursosReact} />
      </div>
    </main>
  </div>
  );
}