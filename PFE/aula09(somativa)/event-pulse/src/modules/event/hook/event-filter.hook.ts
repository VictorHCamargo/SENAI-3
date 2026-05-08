import { useContext } from "react";
import { EventFilterContext } from "../context/event-filter.context";

export function useEventFilter() {
    const context = useContext(EventFilterContext);
    if (!context) throw new Error("useEventFilter deve ser usado dentro do EventFilterProvider");
    return context;
}