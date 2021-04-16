import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-match',
  templateUrl: './match.component.html',
  styleUrls: ['./match.component.css']
})
export class MatchComponent implements OnInit {

  @Input() match;
  matchdata;
  teams;
  me;
  result

  constructor() { 
    
  }

  ngOnInit(): void {
    console.log(this.match);
    this.teams = this.match.teams;
    this.me = this.match
    let myId = this.match.participantId;
    this.me = Object.values(this.match.teams)[0][`p${myId}`];
    if(this.match.participantId > 5){
      this.me = Object.values(this.match.teams)[1][`p${myId}`];
    }
    this.matchdata = this.match.data;
    this.result = this.me.data.stats.result;

  }

}
