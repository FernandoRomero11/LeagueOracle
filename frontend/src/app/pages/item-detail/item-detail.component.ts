import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { ItemsService } from 'src/app/services/items.service';

@Component({
  selector: 'app-item-detail',
  templateUrl: './item-detail.component.html'
})
export class ItemDetailComponent implements OnInit {

  itemId = 0;
  item = [];

  constructor(private route: ActivatedRoute, private itemsService: ItemsService) { }

  ngOnInit(): void {
    this.itemId = +this.route.snapshot.paramMap.get("id");
    this.getItemInfo();
  }

  getItemInfo(){
    if(this.itemId != 0){
      let myItemInfo$ = this.itemsService.getItemInfo(this.itemId);
      myItemInfo$.subscribe(result => {
        console.log(result);
        this.item = result;
      })
    }

  }

}
