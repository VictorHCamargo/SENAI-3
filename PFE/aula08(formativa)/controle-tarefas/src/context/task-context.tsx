import { createContext } from "react";
import { ITaskContextConfig } from "./interfaces/task-context-config";

export const TaskContext = createContext<ITaskContextConfig | null>(null);