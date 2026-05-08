import { IEventConfig } from "./event-config";

export interface IEventContextConfig {
    events: IEventConfig[]
    addEvent: (title: string, type: string, vagas: number) => void
    toggleStatus: (id: string) => void
    deleteEvent: (id: string) => void
    subscribe: (id: string) => void
    clearTimeline: () => void
    editEvent: (id: string,title: string, type: string, vagas: number) => void
}
