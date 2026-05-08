import { useState } from "react";
import { useEventFilter } from "../../hook/event-filter.hook";
import { useEvents } from "../../hook/event.hook";
import { EditModal } from "../event-edit-modal/event-edit-modal";
import { IEventConfig } from "../../interfaces/event-config";

export function EventList() {
    const { events, toggleStatus, deleteEvent, subscribe: inscreverAluno } = useEvents();
    const { filter, searchTerm } = useEventFilter();
    const [editingEvent, setEditingEvent] = useState<IEventConfig | null>(null);

    const filteredEvents = events
        .filter((event) => {
            if (filter.filterBy === "agendado") return event.status === "agendado";
            if (filter.filterBy === "emAndamento") return event.status === "emAndamento";
            if (filter.filterBy === "encerrado") return event.status === "encerrado";
            return true;
        })
        .filter((event) =>
            event.title.toLowerCase().includes(searchTerm.toLowerCase())
        )
        .sort((a, b) => {
            if (a.type === "Workshop" && b.type !== "Workshop") return -1;
            if (a.type !== "Workshop" && b.type === "Workshop") return 1;
            return 0;
        });

    return (
        <main className="event-grid">
            {filteredEvents.map((item) => (
                <div
                    key={item.id}
                    className={`event-card ${item.type.toLowerCase()} ${item.status
                        .toLowerCase()
                        .replace(" ", "-")}`}
                >
                    <div className="event-content">
                        {item.type === "Workshop" && (
                            <span className="workshop-pin">⭐ Workshop em Destaque</span>
                        )}
                        <h3>{item.title}</h3>
                        <span className="event-tag">Tipo: {item.type}</span>
                        <span className="status-badge">Status: {item.status}</span>
                        <span className={`vagas-badge ${item.vacancies === 0 ? "esgotado" : ""}`}>
                            Vagas: {item.vacancies === 0 ? "Esgotado" : item.vacancies}
                        </span>
                        <small>Registrado em: {item.date}</small>
                    </div>
                    <div className="event-actions">
                        {
                            item.status !== "encerrado" && (
                                <button
                                    onClick={() => inscreverAluno(item.id)}
                                    className={`enroll-btn ${item.vacancies === 0 ? "esgotado" : ""}`}
                                    disabled={item.vacancies === 0}
                                >
                                    {item.vacancies === 0 ? "Esgotado" : "Inscrever Aluno"}
                                </button>
                            )
                        }
                        {
                            item.status === 'encerrado' && (
                                <button
                                    className={`enroll-btn ${item.status === 'encerrado' ? "esgotado" : ""}`}
                                    disabled={item.status === 'encerrado'}
                                >
                                    {"Evento Encerrado!"}
                                </button>
                            )
                        }

                        <button onClick={() => toggleStatus(item.id)} className="status-btn">
                            {item.status === "agendado"
                                ? "Iniciar"
                                : item.status === "emAndamento"
                                ? "Encerrar"
                                : "Reiniciar"}
                        </button>
                        <button onClick={() => deleteEvent(item.id)} className="delete">
                            Remover
                        </button>
                        <button onClick={() => setEditingEvent(item)} className="edit">
                            Editar
                        </button>
                    </div>
                </div>
            ))}
            {editingEvent && (
                <EditModal onClose={() => setEditingEvent(null)} event={editingEvent} />
            )}
        </main>
    );
}
