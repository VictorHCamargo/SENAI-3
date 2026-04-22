import { IContadorCliquesConfig } from "../interfaces/contador-cliques-config";

export function ContadorCliques({ cliques, setCliques } : IContadorCliquesConfig) {
    return (

        <div style={{ padding: '15px', border: '1px solid #646cff', marginTop:
        '10px', borderRadius: '8px' }}>
            <p>Botão clicado <strong>{cliques}</strong> vezes</p>
            <button onClick={function() { setCliques(cliques + 1) }}>
                Incrementar
            </button>
        </div>
    );
}