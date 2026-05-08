export type TEventStatus = 'agendado' | 'emAndamento' | 'encerrado'

export interface IEventConfig {
    id: string
    title: string
    type: string
    status: TEventStatus
    date: string
    vacancies: number
}
