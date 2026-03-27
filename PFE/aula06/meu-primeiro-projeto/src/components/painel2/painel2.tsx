import { useState } from "react";

export function Painel2() {
    const [texto,setTexto] = useState('');

    return (
        <div style={{backgroundColor : "#f9f9f9",padding: "15px", border : "1px dashed #666",marginTop: "20px"}}>
            <h4>Escreva uma Mensagem:</h4>
            <input type="text" placeholder="Digite algo..." onChange={(e) => setTexto(e.target.value)} style={{padding : '15px',width : '80%'}}/>
            <p>O que você digitou: <span style={{color : '#f00'}}>{texto}</span></p>
        </div>
    )
}