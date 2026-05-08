import { IEventConfig } from "../../../interfaces/event-config";
import { IModalConfig } from "../../../interfaces/modal-config";

export type TEditModalConfig = IModalConfig & {
    event : IEventConfig
}