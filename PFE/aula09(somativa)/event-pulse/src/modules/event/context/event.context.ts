import { createContext } from "react";
import { IEventContextConfig } from "../interfaces/event-context-config";

export const EventContext = createContext<IEventContextConfig | null>(null);