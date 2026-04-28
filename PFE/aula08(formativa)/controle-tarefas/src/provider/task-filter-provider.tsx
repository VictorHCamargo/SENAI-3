import { ReactNode, useState } from "react";
import { ITaskFilterConfig } from "../shared/interfaces/task-filter-config";
import { TaskFilterContext } from "../context/task-filter-context";

export function TaskFilterProvider({ children } : { children: ReactNode }) {
    const [filter, setFilter] = useState<ITaskFilterConfig>({filterBy : "todas"});
    const [search, setSearch] = useState("");
    const filterOptions: ITaskFilterConfig["filterBy"][] = ["todas", "pendentes", "concluidas"];

    function changeFilter(option: ITaskFilterConfig["filterBy"]) {
        setFilter({ filterBy: option });
    }

    function searchChange (text : string) {
        setSearch(text);
    }
    return (
        <TaskFilterContext.Provider value={{ filter, search, filterOptions, changeFilter, searchChange }}>
            {children}
        </TaskFilterContext.Provider>
    );
}