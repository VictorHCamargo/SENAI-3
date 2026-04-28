import { ITaskFilterConfig } from "../../shared/interfaces/task-filter-config";

export interface ITaskFilterContextConfig {
    filter: ITaskFilterConfig;
    filterOptions: ITaskFilterConfig["filterBy"][];
    changeFilter: (option: ITaskFilterConfig["filterBy"]) => void;
    search : string;
    searchChange : (text : string) => void;
}