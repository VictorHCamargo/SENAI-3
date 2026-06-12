import { Injectable, signal } from '@angular/core';
import { IStudentModel } from '../interface/student-model';
import { ICoursesModel } from '../interface/courses-model';

@Injectable({
  providedIn: 'root',
})
export class StudentsService {
  students = signal<IStudentModel[]>([
    { id: '001', name: 'Ana Silva', course: 'Informática', status: 'paid' },
    { id: '002', name: 'Carlos Souza', course: 'Mecatrônica', status: 'pending' },
    { id: '003', name: 'Juliana Lima', course: 'Administração', status: 'paid' },
    { id: '004', name: 'Pedro Costa', course: 'Eletrotécnica', status: 'pending' },
    { id: '005', name: 'Mariana Reis', course: 'Enfermagem', status: 'paid' },
    { id: '006', name: 'Lucas Mendes', course: 'Informática', status: 'pending' },
    { id: '007', name: 'Fernanda Gomes', course: 'Mecatrônica', status: 'paid' },
    { id: '008', name: 'Rafael Torres', course: 'Administração', status: 'pending' },
    { id: '009', name: 'Beatriz Nunes', course: 'Eletrotécnica', status: 'paid' },
    { id: '010', name: 'Diego Alves', course: 'Enfermagem', status: 'pending' },
  ])

  courses = signal<ICoursesModel[]>([
    {
      title: 'Informática'
    },
    { title: 'Mecatrônica' }
  ]);

  add(student: IStudentModel): void {
    this.students.update(list => [...list, { ...student }])
  }

  update(updated: IStudentModel): void {
    this.students.update(list =>
      list.map(s => s.id === updated.id ? updated : s)
    )
  }

  remove(id: string): void {
    this.students.update(list => list.filter(s => s.id !== id))
  }

  getById(id: string): IStudentModel | undefined {
    return this.students().find(s => s.id === id)
  }
}
