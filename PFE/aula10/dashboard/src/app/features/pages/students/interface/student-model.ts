export interface IStudentModel {
    id: string,
    name: string,
    course: string,
    status: TStatusPayment
}

export type TStatusPayment = 'paid' | 'pending'