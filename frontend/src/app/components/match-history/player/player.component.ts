import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-player',
  templateUrl: './player.component.html',
  styleUrls: ['player.component.css']
})
export class PlayerComponent implements OnInit {

  @Input() player;
  name;

  constructor() { }

  ngOnInit(): void {
    this.name = this.player.identity.player.summonerName;
    if(this.name.length > 10){
      this.name = this.name.substring(0,13)+"-";
    }
  }

}
