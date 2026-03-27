import { useState } from 'react'
import './App.css'
import { GridPainel } from './components/grid-painel/grid-painel'
import { Painel2 } from './components/painel2/painel2'
import { PainelFutebol } from './components/painel-futebol/painel-futebol'

function App() {
  return (
    <>
      <h1>Olá, React!</h1>
      <p>Estou alterando meu primeiro componente.</p>
      
      <GridPainel profiles={[
        {
          perfil : {name : "Victor", role : "Aluno", describe : "Aluno folgado"},
        },
        {
          perfil : {name : "Samuel", role : "Professor", describe : "Professor top"}
        },
        {
          perfil : {name : "Beatriz", role : "Aluno", describe : "Aluna Dedicada"}
        },
        {
          perfil : {name : "Luiza", role : "Aluno", describe : "Aluna Dedicada"}
        },
        {
          perfil : {name : "Guilherme", role : "Aluno", describe : "Aluno Dedicado"}
        },
        {
          perfil : {name : "Bruno", role : "Professor", describe : "Professor top"}
        }
      ]}></GridPainel>

      <Painel2></Painel2>

      <PainelFutebol nomeTimeA='Flamengo' nomeTimeB='Santos'></PainelFutebol>
    </>
  )
}

export default App


