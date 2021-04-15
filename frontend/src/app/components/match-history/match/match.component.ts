import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-match',
  templateUrl: './match.component.html'
})
export class MatchComponent implements OnInit {

  @Input() match;
  teams;

  constructor() { 
    
  }

  ngOnInit(): void {
    //console.log(this.match);
    this.teams = this.match.teams;
  }

}
