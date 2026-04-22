import { IListaRecursosConfig } from "../interfaces/lista-recursos-config";

export function ListaRecursos({ itens } : IListaRecursosConfig) {
    return (
        <ul style={{ textAlign: 'left', display: 'inline-block' }}>
            {itens.map(function(item, index) {
            return <li key={index} style={{ marginBottom: '5px' }}>{item}</li>;
            })}
        </ul>

    );
}