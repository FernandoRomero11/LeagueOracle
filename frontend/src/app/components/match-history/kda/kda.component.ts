import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-kda',
  templateUrl: './kda.component.html'
})
export class KdaComponent implements OnInit {

  @Input() me;

  constructor() { }

  ngOnInit(): void {
  }

}
