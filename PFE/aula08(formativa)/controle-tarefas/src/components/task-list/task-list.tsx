import { useState } from "react";
import { useTaskFilter } from "../../hook/task-filter-hook";
import { useTasks } from "../../hook/task-hook";
import { ITaskConfig } from "../../shared/interfaces/task-config";
const PRIORITY_ORDER: Record<string, number> = {
  Alta: 0,
  Média: 1,
  Baixa: 2,
};
export function TaskList() {
    const { tasks, toggleTask, deleteTask, updateTask } = useTasks();
    const { filter, search } = useTaskFilter();

    const [editingId, setEditingId] = useState<number | null>(null);
    const [editingText, setEditingText] = useState("");

    const filteredTasks = tasks
    .filter((t: ITaskConfig) => {
      if (filter.filterBy === "pendentes") return !t.completed;
      if (filter.filterBy === "concluidas") return t.completed;
      return true;
    }).filter((t: ITaskConfig) =>
        t.text.toLowerCase().includes(search.toLowerCase()) 
    )
    .sort((a, b) => PRIORITY_ORDER[a.priority] - PRIORITY_ORDER[b.priority]);
    function onEditStart(item: ITaskConfig) {
        setEditingId(item.id);
        setEditingText(item.text);
    }

    function onEditSave(id: number) {
        if (!editingText.trim()) return;
        updateTask(id, editingText);
        setEditingId(null);
    }

    function onDelete(id: number) {
        const confirmed = window.confirm("Tem certeza que deseja remover esta tarefa?");
        if (confirmed) deleteTask(id);
    }
    return (
    <main className="task-grid">
        {filteredTasks.map((item: ITaskConfig) => (
            <div
            key={item.id}
            className={`task-card ${item.priority.toLowerCase()} ${item.completed ? "done" : ""}`}
            >
            <div className="task-content">
                {editingId === item.id ? (
                <input
                    autoFocus
                    value={editingText}
                    onChange={(e) => setEditingText(e.target.value)}
                    onKeyDown={(e) => e.key === "Enter" && onEditSave(item.id)}
                />
                ) : (
                <h3>{item.text}</h3>
                )}
                <span>Prioridade: {item.priority}</span>
                <small>Criada em: {item.createdAt}</small>
            </div>

            <div className="task-actions">
                <button onClick={() => toggleTask(item.id)}>
                    {item.completed ? "Reabrir" : "Concluir"}
                </button>
                    {editingId === item.id ? (
                        <button onClick={() => onEditSave(item.id)}>Salvar</button>
                    ) : (
                        <button onClick={() => onEditStart(item)}>Editar</button>
                    )
                }

                <button onClick={() => onDelete(item.id)} className="delete">
                    Remover
                </button>
            </div>
            </div>
        ))}
        </main>
  );
}