import { Component, computed, inject, signal, Signal } from '@angular/core';
import { StudentsService } from '../service/students-service';
import { IStudentModel } from '../interface/student-model';
import { Students } from '../students-form/students';

@Component({
  selector: 'app-students-list',
  imports: [Students],
  templateUrl: './students-list.html',
})
export class StudentsList {
  studentsService = inject(StudentsService);

  students! : Signal<IStudentModel[]>

  constructor() {
    this.students = computed(() => {
      return this.studentsService.students()
    })
  }

  pageSize = 5
  currentPage = signal<number>(1)

  totalPages = computed(() => Math.ceil(this.students().length / this.pageSize))

  paginatedStudents = computed(() => {
    const start = (this.currentPage() - 1) * this.pageSize
    return this.students().slice(start, start + this.pageSize)
  })

  pages = computed(() => Array.from({ length: this.totalPages() }, (_, i) => i + 1))

  goToPage(page: number) {
    if (page >= 1 && page <= this.totalPages()) {
      this.currentPage.set(page)
    }
  }
}
