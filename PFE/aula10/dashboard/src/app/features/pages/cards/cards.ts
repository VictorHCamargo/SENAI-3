import { Component } from '@angular/core';
import { ICardModel } from './interface/card-model';

@Component({
  selector: 'app-cards',
  imports: [],
  templateUrl: './cards.html',
})
export class Cards {
  cards: ICardModel[] = [
    {
      title: 'Total de Alunos Ativos',
      color: 'primary'
    },
    {
      title: 'Cursos Publicados',
      color: 'success'
    },
    {
      title: 'Taxa de Retenção',
      color: 'warning'
    },
    {
      title: 'Chamados Abertos',
      color: 'danger'
    }
  ]
}
