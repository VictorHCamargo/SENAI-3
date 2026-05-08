import { ReactNode, useState } from "react";
import { IEventFilterConfig } from "../interfaces/event-filter-config";
import { EventFilterContext } from "../context/event-filter.context";

export function EventFilterProvider({ children }: { children: ReactNode }) {
    const [filter, setFilter] = useState<IEventFilterConfig>({ filterBy: "todas" });
    const [searchTerm, setSearchTerm] = useState("");
    const filterOptions: IEventFilterConfig['filterBy'][] = ['agendado', 'emAndamento', 'encerrado', 'todas'];

    function changeFilter(options: IEventFilterConfig['filterBy']) {
        setFilter({ filterBy: options });
    }

    return (
        <EventFilterContext.Provider value={{ filter, filterOptions, changeFilter, searchTerm, setSearchTerm }}>
            {children}
        </EventFilterContext.Provider>
    );
}
