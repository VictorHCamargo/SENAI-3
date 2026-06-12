import { Routes } from "@angular/router";

export const StudentsRoutes : Routes = [
    {
        path : 'list',
        loadComponent : () => import('../students-list/students-list').then( (c) => c.StudentsList)
    }
]