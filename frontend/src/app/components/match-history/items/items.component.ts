import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-items',
  templateUrl: './items.component.html',
  styleUrls: ['./items.component.css']
})
export class ItemsComponent implements OnInit {

  @Input() me;
  item0;
  item1;
  item2;
  item3;
  item4;
  item5;
  item6;

  constructor() { }

  ngOnInit(): void {
    this.item0 = this.me.data.stats.item0;
    this.item1 = this.me.data.stats.item1;
    this.item2 = this.me.data.stats.item2;
    this.item3 = this.me.data.stats.item3;
    this.item4 = this.me.data.stats.item4;
    this.item5 = this.me.data.stats.item5;
    this.item6 = this.me.data.stats.item6;
    console.log(this.me.data.stats);
  }

}
