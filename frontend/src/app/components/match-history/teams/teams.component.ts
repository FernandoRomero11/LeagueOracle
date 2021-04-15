import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-teams',
  templateUrl: './teams.component.html'
})
export class TeamsComponent implements OnInit {

  @Input() teams;
  
  constructor() { }

  ngOnInit(): void {
    this.teams = Object.values(this.teams);
   // console.log(this.teams);
  }

}
