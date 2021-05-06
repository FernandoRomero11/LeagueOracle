import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ChampionsService } from 'src/app/services/champions.service';

@Component({
  selector: 'app-champion-detail',
  templateUrl: './champion-detail.component.html'
})
export class ChampionDetailComponent implements OnInit {

  championId = "";
  champion;
  spells;

  constructor(private route: ActivatedRoute, private championsService: ChampionsService) { }

  ngOnInit(): void {
    this.championId = this.route.snapshot.paramMap.get("id");
    this.getChampionInfo();
  }

  getChampionInfo(): void{
    if(this.championId != ""){
      let myChampInfo$ = this.championsService.getChampionInfo(this.championId);
      myChampInfo$.subscribe(result => {
        this.champion = result;
        this.spells = Object.values(this.champion.spells);
        console.log(this.champion);
      })
    }
  }
}
