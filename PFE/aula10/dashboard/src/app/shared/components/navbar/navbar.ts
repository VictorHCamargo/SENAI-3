import { Component, input } from '@angular/core';
import { INavbarModel } from './interface/navbar-model';
import { RouterLink } from "@angular/router";

@Component({
  selector: 'app-navbar',
  imports: [RouterLink],
  templateUrl: './navbar.html',
})
export class Navbar {
  paths = input.required<INavbarModel[]>()
}
