import { createContext } from "react";
import { ITaskFilterContextConfig } from "./interfaces/task-filter-context-config";

export const TaskFilterContext = createContext<ITaskFilterContextConfig | null>(null)