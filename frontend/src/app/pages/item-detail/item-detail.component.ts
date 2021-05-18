import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, } from "@angular/router";
import { ItemsService } from 'src/app/services/items.service';

@Component({
  selector: 'app-item-detail',
  templateUrl: './item-detail.component.html',
  styleUrls: ['./item-detail.component.css']
})
export class ItemDetailComponent implements OnInit {

  itemId = 0;
  item;

  constructor(private route: ActivatedRoute, private itemsService: ItemsService) {
    this.route.params.subscribe(params => {
      this.itemsService.getItemInfo(params['id'])
        .subscribe(item => {
          this.item = item;
          this.item.stats = Object.entries(this.item.stats);
          this.item.from = Object.entries(this.item.from);
          this.item.into = Object.entries(this.item.into);
        })
    })
  }

  ngOnInit(): void {
    this.itemId = +this.route.snapshot.paramMap.get("id");
    this.getItemInfo();
  }

  getItemInfo(): void{
    if(this.itemId != 0){
      let myItemInfo$ = this.itemsService.getItemInfo(this.itemId);
      myItemInfo$.subscribe(result => {
        this.item = result;
        this.item.stats = Object.entries(this.item.stats);
        this.item.from = Object.entries(this.item.from);
        this.item.into = Object.entries(this.item.into);
        console.log(this.item);
      })
    }
  }

}
