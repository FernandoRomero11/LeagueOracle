import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from "@angular/router";
import { ItemsService } from 'src/app/services/items.service';

@Component({
  selector: 'app-item-detail',
  templateUrl: './item-detail.component.html'
})
export class ItemDetailComponent implements OnInit {

  itemId = 0;
  item;

  constructor(private route: ActivatedRoute, private itemsService: ItemsService) { }

  ngOnInit(): void {
    this.itemId = +this.route.snapshot.paramMap.get("id");
    this.getItemInfo();
  }

  getItemInfo(): void{
    if(this.itemId != 0){
      let myItemInfo$ = this.itemsService.getItemInfo(this.itemId);
      myItemInfo$.subscribe(result => {
        this.item = result;
        console.log(this.item.description);
        //this.item.description = this.item.description.replace(/<((?=!\-\-)!\-\-[\s\S]*\-\-|((?=\?)\?[\s\S]*\?|((?=\/)\/[^.\-\d][^\/\]'"[!#$%&()*+,;<=>?@^`{|}~ ]*|[^.\-\d][^\/\]'"[!#$%&()*+,;<=>?@^`{|}~ ]*(?:\s[^.\-\d][^\/\]'"[!#$%&()*+,;<=>?@^`{|}~ ]*(?:=(?:"[^"]*"|'[^']*'|[^'"<\s]*))?)*)\s?\/?))>/g," "); 
      })
    }

  }

}
