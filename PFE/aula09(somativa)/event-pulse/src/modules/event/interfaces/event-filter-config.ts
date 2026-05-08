import { TEventStatus } from "./event-config";

type TFilterByOptions = TEventStatus | 'todas';

export interface IEventFilterConfig {
    filterBy : TFilterByOptions
}