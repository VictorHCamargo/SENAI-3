import { ReactNode, useState } from "react";
import { ITaskConfig } from "../shared/interfaces/task-config";
import { TaskContext } from "../context/task-context";

export function TaskProvider({ children }: { children: ReactNode }) {
    const [tasks, setTasks] = useState<ITaskConfig[]>([]);

    function addTask(text: string, priority: string) {
        const newTask: ITaskConfig = {
            id: Date.now(),
            text,
            priority,
            completed: false,
            createdAt: new Date().toLocaleDateString("pt-BR"),
        };
        setTasks((prev) => [...prev, newTask]);
    }

    function toggleTask(id: number) {
        setTasks((prev) =>
            prev.map((task) =>
                task.id === id ? { ...task, completed: !task.completed } : task
            )
        );
    }

    function updateTask(id: number, text: string) {
        setTasks((prev) =>
            prev.map((task) =>
            task.id === id ? { ...task, text } : task
            )
        );
    }

    function deleteTask(id: number) {
        setTasks((prev) => prev.filter((task) => task.id !== id));
    }

    return (
        <TaskContext.Provider value={{ tasks, addTask, toggleTask,updateTask, deleteTask }}>
            {children}
        </TaskContext.Provider>
    );
}