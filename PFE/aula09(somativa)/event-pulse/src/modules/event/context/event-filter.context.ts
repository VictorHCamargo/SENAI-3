import { createContext } from "react";
import { IEventFilterContextConfig } from "../interfaces/event-filter-context-config";

export const EventFilterContext = createContext<IEventFilterContextConfig | null>(null);