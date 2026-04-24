import { useState } from "react";
import { useTasks } from "../../hook/task-hook";

export function TaskInput() {
    const { addTask } = useTasks();
    const [taskText, setTaskText] = useState("");
    const [priority, setPriority] = useState("Baixa");

    function onSubmit(e: React.SubmitEvent) {
        e.preventDefault();
        if (!taskText.trim()) return;
        addTask(taskText, priority);
        setTaskText("");
    }

    return (
        <section className="form-section">
            <form onSubmit={onSubmit}>
            <input
                value={taskText}
                onChange={(e) => setTaskText(e.target.value)}
                placeholder="Descrição da tarefa..."
            />
            <select value={priority} onChange={(e) => setPriority(e.target.value)}>
                <option value="Baixa">Baixa</option>
                <option value="Média">Média</option>
                <option value="Alta">Alta</option>
            </select>
            <button type="submit">Criar</button>
            </form>
        </section>
    );
}