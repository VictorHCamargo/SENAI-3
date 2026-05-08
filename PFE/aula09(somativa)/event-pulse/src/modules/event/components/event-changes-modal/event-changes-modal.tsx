import { IChangesDescriptionConfig } from "./interfaces/changes-description-config";
import { IModalConfig } from "../../interfaces/modal-config";

export function ChangesModal({ onClose }: IModalConfig) {
    const changes : IChangesDescriptionConfig[]= [
        {
            title: "1. Fundo com Gradiente Animado",
            description: "O body recebe um gradiente diagonal de 3 cores (roxo, azul e índigo) com animação contínua via @keyframes, criando um efeito de fluxo vivo na página inteira.",
        },
        {
            title: "2. Cards com Glassmorphism",
            description: "Os cards de evento passaram a usar backdrop-filter: blur(12px) com fundo semi-transparente e borda translúcida, criando o efeito 'vidro fosco' sobre o gradiente animado do fundo.",
        },
        {
            title: "3. Título com Gradiente Animado (Shimmer)",
            description: "O h1 'EventPulse' usa background-clip: text com um gradiente em movimento contínuo via @keyframes shimmer, criando um efeito de brilho deslizante no texto.",
        },
    ];

    return (
        <div className="modal-overlay" onClick={onClose}>
            <div className="modal-box" onClick={(e) => e.stopPropagation()}>
                <h2>✨ Alterações de Estilo CSS</h2>
                <ul className="modal-changes-list">
                    {changes.map((change, index) => (
                        <li key={index}>
                            <strong>{change.title}</strong>
                            <p>{change.description}</p>
                        </li>
                    ))}
                </ul>
                <button onClick={onClose} className="modal-close">
                    Fechar
                </button>
            </div>
        </div>
    );
}
