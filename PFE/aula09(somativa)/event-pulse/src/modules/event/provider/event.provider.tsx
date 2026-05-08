import { ReactNode, useEffect, useState } from "react";
import { IEventConfig } from "../interfaces/event-config";
import { EventContext } from "../context/event.context";

export function EventProvider({ children }: { children: ReactNode }) {
    const LOCALSTORAGE_KEY = "@eventpulse_data";
    const [events, setEvents] = useState<IEventConfig[]>([]);

    useEffect(() => {
        const savedEvents = localStorage.getItem(LOCALSTORAGE_KEY);
        if (savedEvents) setEvents(JSON.parse(savedEvents));
    }, []);

    useEffect(() => {
        localStorage.setItem(LOCALSTORAGE_KEY, JSON.stringify(events));
    }, [events]);

    function addEvent(title: string, type: string, vagas: number) {
        const newEvent: IEventConfig = {
            id: crypto.randomUUID(),
            title,
            type,
            status: 'agendado',
            date: new Date().toLocaleDateString(),
            vacancies: vagas
        };
        setEvents((prevEvents) => [...prevEvents, newEvent]);
    }

    function toggleStatus(id: string) {
        setEvents(events.map((event) => {
            if (event.id === id) {
                const nextStatus = event.status === 'agendado'
                    ? 'emAndamento'
                    : event.status === 'emAndamento'
                    ? 'encerrado'
                    : 'agendado';
                return { ...event, status: nextStatus };
            }
            return event;
        }));
    }

    function deleteEvent(id: string) {
        setEvents(events.filter((event) => event.id !== id));
    }

    function subscribe(id: string) {
        setEvents(events.map((event) => {
            if (event.id === id && event.vacancies > 0) {
                return { ...event, vacancies: event.vacancies - 1 };
            }
            return event;
        }));
    }

    function clearTimeline() {
        const confirmed = window.confirm(
            "Tem certeza que deseja limpar todo o cronograma? Esta ação não pode ser desfeita."
        );
        if (confirmed) {
            localStorage.removeItem(LOCALSTORAGE_KEY);
            setEvents([]);
        }
    }

    function editEvent(id: string, title: string, type: string, vagas: number) {
        setEvents((prev) =>
            prev.map((event) => {
                if (event.id !== id) return event;
                return { ...event, title, type, vacancies: vagas };
            })
        );
    }

    return (
        <EventContext.Provider value={{ events, addEvent, toggleStatus, deleteEvent, subscribe, clearTimeline, editEvent }}>
            {children}
        </EventContext.Provider>
    );
}
