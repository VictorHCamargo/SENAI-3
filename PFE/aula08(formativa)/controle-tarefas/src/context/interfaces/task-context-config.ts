import { ITaskConfig } from "../../shared/interfaces/task-config";

export interface ITaskContextConfig {
    tasks: ITaskConfig[];
    addTask: (text: string, priority: string) => void;
    toggleTask: (id: number) => void;
    deleteTask: (id: number) => void;
    updateTask: (id: number, text: string) => void;
}