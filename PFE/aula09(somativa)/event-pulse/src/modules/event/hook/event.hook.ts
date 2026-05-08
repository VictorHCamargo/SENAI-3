import { useContext } from "react";
import { EventContext } from "../context/event.context";

export function useEvents() {
    const context = useContext(EventContext);
    if (!context) throw new Error("useEvent deve ser usado dentro do EventProvider");
    return context;
}