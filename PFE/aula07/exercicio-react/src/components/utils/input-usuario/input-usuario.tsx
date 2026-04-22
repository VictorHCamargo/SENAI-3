import { IInputUsuarioConfig } from "../interfaces/input-usuario-config";

export function InputUsuario({ nome, setNome } : IInputUsuarioConfig) {
    return (
        <div style={{ margin: '20px 0' }}>
            <label>Digite seu nome: </label>
            <input
            type="text"
            value={nome}
            onChange={(e) => setNome(e.target.value)}
            placeholder="Seu nome aqui..."
            style={{ padding: '8px', borderRadius: '4px', border: '1px solid #ccc' }}
            />

        </div>
    );
}