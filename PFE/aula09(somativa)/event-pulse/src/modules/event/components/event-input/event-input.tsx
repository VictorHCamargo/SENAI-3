import React, { useState } from "react";
import { useEvents } from "../../hook/event.hook";

export function EventInput() {
    const { addEvent } = useEvents();
    const [eventTitle, setEventTitle] = useState("");
    const [eventType, setEventType] = useState("Palestra");
    const [eventVagas, setEventVagas] = useState(10);

    function onSubmit(e: React.FormEvent) {
        e.preventDefault();
        if (!eventTitle.trim()) return;
        addEvent(eventTitle, eventType, eventVagas);
        setEventTitle("");
    }

    return (
        <section className="form-section">
            <form onSubmit={onSubmit}>
                <input
                    value={eventTitle}
                    onChange={(e) => setEventTitle(e.target.value)}
                    placeholder="Nome do evento ou atividade..."
                />
                <select value={eventType} onChange={(e) => setEventType(e.target.value)}>
                    <option value="Palestra">Palestra</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Painel">Painel</option>
                </select>
                <select value={eventVagas} onChange={(e) => setEventVagas(Number(e.target.value))}>
                    <option value={10}>10 vagas</option>
                    <option value={30}>30 vagas</option>
                    <option value={50}>50 vagas</option>
                </select>
                <button type="submit">Agendar</button>
            </form>
        </section>
    );
}
