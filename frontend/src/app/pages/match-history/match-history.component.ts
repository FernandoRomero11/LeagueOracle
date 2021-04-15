import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { MatchHistoryService } from 'src/app/services/match-history.service';

@Component({
  selector: 'app-match-history',
  templateUrl: './match-history.component.html'
})
export class MatchHistoryComponent implements OnInit {

  summonerName = "";
  matchs;

  constructor(private route: ActivatedRoute, private matchHistoryService: MatchHistoryService) { }

  ngOnInit(): void {
    this.summonerName = this.route.snapshot.paramMap.get("summonerName");
    this.getMatchs();
  }

  getMatchs(): void{
    if(this.summonerName != ""){
      let myMatchs$ = this.matchHistoryService.getMatchs(this.summonerName);
      myMatchs$.subscribe(result => {
        this.matchs = result;
        console.log(this.matchs);
      })
    }

  }

}
