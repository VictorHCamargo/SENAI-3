import { Component, inject, signal } from '@angular/core';
import { form, FormField, minLength, required } from '@angular/forms/signals';
import { IStudentModel } from '../../../interface/student-model';
import { StudentsService } from '../../../service/students-service';

@Component({
  selector: 'app-modal',
  imports: [FormField],
  templateUrl: './modal.html',
})
export class Modal {
  studentsService = inject(StudentsService);

  model = signal<IStudentModel>({
    id: '',
    name: '',
    course: '',
    status: 'pending'
  })
  formData = form<IStudentModel>(this.model, (path) => {
    required(path.name, { message: 'Nome é obrigatório' })
    minLength(path.name, 3, { message: 'Nome deve ter ao menos 3 caracteres' })
    required(path.course, { message: 'Curso é obrigatório' })
    required(path.status, { message: 'Status é obrigatório' })
  })

  onSave() {
    if (this.isDisabled) return
    this.studentsService.add(this.model());
    this.cleanModel()
  }
  
  cleanModel() {
    this.model.set({
      id: '',
      name: '',
      course: '',
      status: 'pending'
    })
  }

  get isDisabled(): boolean {
    return this.formData().invalid()
  }
}
