import { useState } from "react";
import { IModalConfig } from "../../interfaces/modal-config";
import { TEditModalConfig } from "./interfaces/edit-modal-config";
import { useEvents } from "../../hook/event.hook";

export function EditModal({ event, onClose }: TEditModalConfig) {
    const {editEvent} = useEvents();
    const [title, setTitle] = useState(event.title);
    const [type, setType] = useState(event.type);
    const [vagas, setVagas] = useState(event.vacancies);

    function onUpdate(e: React.SubmitEvent) {
        e.preventDefault();
        editEvent(event.id, title, type, vagas);
        onClose();
    }

    return (
        <div className="modal-overlay" onClick={onClose}>
            <div className="modal-box" onClick={(e) => e.stopPropagation()}>
                <h2>📝 Editar Evento</h2>
                
                <form onSubmit={onUpdate} className="form-section">
                    <label>Título do Evento:</label>
                    <input
                        value={title}
                        onChange={(e) => setTitle(e.target.value)}
                        placeholder="Nome do evento..."
                        autoFocus
                    />

                    <label>Tipo:</label>
                    <select value={type} onChange={(e) => setType(e.target.value)}>
                        <option value="Palestra">Palestra</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Painel">Painel</option>
                    </select>

                    <label>Vagas:</label>
                    <select value={vagas} onChange={(e) => setVagas(Number(e.target.value))}>
                        <option value={10}>10 vagas</option>
                        <option value={30}>30 vagas</option>
                        <option value={50}>50 vagas</option>
                    </select>

                    <div className="modal-actions">
                        <button type="button" onClick={onClose} className="btn-cancel">
                            Cancelar
                        </button>
                        <button type="submit" className="btn-save">
                            Salvar Alterações
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
        
    );
}