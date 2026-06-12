import { Component, signal } from '@angular/core';
import { Navbar } from './shared/components/navbar/navbar';
import { Sidebar } from './shared/components/sidebar/sidebar';
import { RouterOutlet } from '@angular/router';
import { INavbarModel } from './shared/components/navbar/interface/navbar-model';

@Component({
  selector: 'app-root',
  imports: [Navbar,Sidebar,RouterOutlet],
  templateUrl: './app.html',
  styleUrl: './app.scss'
})
export class App {
  protected readonly title = signal('dashboard');

  paths : INavbarModel[] = [
    {
      name : 'Dashboard',
      way : '',
      children : [
        {
          name : 'Cards',
          way : '/cards',
          children : []
        },
        {
          name : 'Alunos',
          way : '/students/list',
          children : []
        }
      ]
    }
  ]
}
