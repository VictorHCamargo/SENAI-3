import { IEventFilterConfig } from "./event-filter-config"

export interface IEventFilterContextConfig {
    filter: IEventFilterConfig
    filterOptions: IEventFilterConfig['filterBy'][]
    changeFilter: (options: IEventFilterConfig['filterBy']) => void
    searchTerm: string
    setSearchTerm: (term: string) => void
}
