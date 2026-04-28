import { useTaskFilter } from "../../hook/task-filter-hook"

export function TaskSearch() {
    const {search, searchChange} = useTaskFilter();
    return (
        <section className="form-section">
            <input
                value={search}
                onChange={(e) => searchChange(e.target.value)}
                placeholder="Buscar tarefas..."
            />
        </section>
    )
}