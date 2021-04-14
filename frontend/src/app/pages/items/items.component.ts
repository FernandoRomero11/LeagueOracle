import { Component, OnInit } from '@angular/core';
import { ItemsService } from 'src/app/services/items.service';


@Component({
  selector: 'app-items',
  templateUrl: './items.component.html',
  styleUrls: ['./items.component.css']
})
export class ItemsComponent implements OnInit {
  items = [];

  constructor(private itemsService: ItemsService) { }
  
  ngOnInit(): void {
    this.getItems();
  }

  getItems(){
    let myItems$ = this.itemsService.getItems();
    myItems$.subscribe(result => {
      result.sort((a,b) => a.name < b.name ? -1 : 1)
      this.items = result;
    })
  }
}
