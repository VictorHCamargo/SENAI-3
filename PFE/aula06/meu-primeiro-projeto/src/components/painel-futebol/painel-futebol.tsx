import { useState } from "react";
import { IPainelFutebolConfig } from "./interfaces/painel-futebol-config";

export function PainelFutebol({nomeTimeA , nomeTimeB} : IPainelFutebolConfig) {
    const [golsA,setGolsA] = useState(0);
    const [golsB,setGolsB] = useState(0);

    return (
        <div style={{
    border: 'none',
    borderRadius: '20px',
    padding: '30px',
    textAlign: 'center',
    backgroundColor: '#1b5e20',
    backgroundImage: 'linear-gradient(135deg, #1b5e20 0%, #2e7d32 100%)',
    fontFamily: '"Segoe UI", Roboto, Helvetica, Arial, sans-serif',
    margin: '20px auto',
    maxWidth: '500px',
    boxShadow: '0 10px 30px rgba(0,0,0,0.3)',
    color: 'white'
}}>
    <h2 style={{
        textTransform: 'uppercase',
        letterSpacing: '2px',
        fontSize: '18px',
        margin: '0 0 20px 0',
        opacity: 0.9,
        color: '#a5d6a7'
    }}>
        Placar do Jogo
    </h2>

    <div style={{
        display: 'flex',
        justifyContent: 'space-around',
        alignItems: 'center',
        backgroundColor: 'rgba(0,0,0,0.2)',
        borderRadius: '15px',
        padding: '20px'
    }}>
        <div style={{ flex: 1 }}>
            <h3 style={{ margin: '0', fontSize: '16px', fontWeight: '400' }}>{nomeTimeA}</h3>
            <h1 style={{
                fontSize: '64px',
                margin: '10px 0',
                fontFamily: '"Courier New", monospace',
                textShadow: '2px 2px 0px rgba(0,0,0,0.5)',
                color: '#fff'
            }}>{golsA}</h1>
            <button 
                onClick={() => setGolsA(golsA + 1)}
                style={{
                    backgroundColor: '#ffc107',
                    border: 'none',
                    padding: '10px 20px',
                    borderRadius: '8px',
                    fontWeight: 'bold',
                    cursor: 'pointer',
                    color: '#333',
                    transition: 'transform 0.1s'
                }}
            >
                GOL!!
            </button>
        </div>

        <div style={{
            fontSize: '24px',
            fontWeight: 'bold',
            opacity: 0.5,
            padding: '0 20px'
        }}>VS</div>

        <div style={{ flex: 1 }}>
            <h3 style={{ margin: '0', fontSize: '16px', fontWeight: '400' }}>{nomeTimeB}</h3>
            <h1 style={{
                fontSize: '64px',
                margin: '10px 0',
                fontFamily: '"Courier New", monospace',
                textShadow: '2px 2px 0px rgba(0,0,0,0.5)',
                color: '#fff'
            }}>{golsB}</h1>
            <button 
                onClick={() => setGolsB(golsB + 1)}
                style={{
                    backgroundColor: '#ffc107',
                    border: 'none',
                    padding: '10px 20px',
                    borderRadius: '8px',
                    fontWeight: 'bold',
                    cursor: 'pointer',
                    color: '#333'
                }}
            >
                GOL!!
            </button>
        </div>
    </div>
    
    <button 
        onClick={() => { setGolsA(0); setGolsB(0); }}
        style={{
            marginTop: '25px',
            background: 'transparent',
            border: '1px solid rgba(255,255,255,0.3)',
            color: 'white',
            padding: '5px 15px',
            borderRadius: '5px',
            cursor: 'pointer',
            fontSize: '12px'
        }}
    >
        Resetar Partida
    </button>
</div>
    )

}