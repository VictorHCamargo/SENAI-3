import { ICardSaudacaoConfig } from "./interfaces/card-saudacao-config";

export function CardSaudacao({ nome, temaEscuro } : ICardSaudacaoConfig) {
    const estilo = {
        padding: '15px',
        borderRadius: '8px',
        backgroundColor: temaEscuro ? '#333' : '#f9f9f9',
        color: temaEscuro ? '#fff' : '#000',
        marginTop: '10px',
        border: '1px solid #ddd'
    };

    return (
        <div style={estilo}>
            <h3>Olá, {nome || 'Visitante'}!</h3>
            <p>Bem-vindo ao exercício de componentes com Vite e Functions.</p>
        </div>
    );
}