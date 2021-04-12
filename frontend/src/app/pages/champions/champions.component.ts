import { Component, OnInit } from '@angular/core';
import { ChampionsService } from 'src/app/services/champions.service';

@Component({
  selector: 'app-champions',
  templateUrl: './champions.component.html'
})
export class ChampionsComponent implements OnInit {
  champions = [];

  constructor(private championsService: ChampionsService) { }
  
  ngOnInit(): void {
    this.getChampions();
  }

  getChampions(){
    let myChampions$ = this.championsService.getChampions();
    myChampions$.subscribe(result => {
      result.sort((a,b) => a.name < b.name ? -1 : 1)
      this.champions = result;
    })
  }

}
