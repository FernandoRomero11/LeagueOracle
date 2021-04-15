import { Component, HostListener, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { MatchHistoryService } from 'src/app/services/match-history.service';

@Component({
  selector: 'app-match-history',
  templateUrl: './match-history.component.html'
})
export class MatchHistoryComponent implements OnInit {

  summonerName = "";
  matchs = [];
  init = 0;
  end = 3;

  constructor(private route: ActivatedRoute, private matchHistoryService: MatchHistoryService) { 
  }

  ngOnInit(): void {
    this.summonerName = this.route.snapshot.paramMap.get("summonerName");
    this.getMatchs();
  }

  getMatchs(): void{
    if(this.summonerName != ""){
      let myMatchs$ = this.matchHistoryService.getMatchs(this.summonerName,this.init,this.end);
      myMatchs$.subscribe(result => {
        result.map(match => {
          this.matchs = [...this.matchs,match];
        })
        console.log(this.matchs);
        this.init = this.init+3;
        this.end = this.end+3
      })
    }
  }

}
