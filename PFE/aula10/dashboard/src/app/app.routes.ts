import { Routes } from '@angular/router';

export const routes: Routes = [
    {
        path: 'cards',
        loadComponent: () => import('./features/pages/cards/cards').then((c) => c.Cards)
    },
    {
        path: 'students',
        loadChildren: () => import('./features/pages/students/route/students-routes').then((c) => c.StudentsRoutes)
    }
];
