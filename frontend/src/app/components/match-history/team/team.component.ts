import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-team',
  templateUrl: './team.component.html'
})
export class TeamComponent implements OnInit {

  @Input() team;
  players;

  constructor() { }

  ngOnInit(): void {
    //console.log(this.team);
    this.players = Object.values(this.team);
  }

}
