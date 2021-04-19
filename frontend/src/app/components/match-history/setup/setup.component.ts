import { Component, Input, OnInit } from '@angular/core';

@Component({
  selector: 'app-setup',
  templateUrl: './setup.component.html'
})
export class SetupComponent implements OnInit {

  @Input() me;
  @Input() matchdata;
  result;
  time;
  date;

  constructor() { }

  ngOnInit(): void {
    console.log(this.me)
    this.result = this.me.data.stats.result?"VICTORY":"DEFEAT";
    this.time = this.format(this.matchdata.duration);
  }

  format(time){
    // Hours, minutes and seconds
    var hrs = ~~(time / 3600);
    var mins = ~~((time % 3600) / 60);
    var secs = ~~time % 60;

    // Output like "1:01" or "4:03:59" or "123:03:59"
    var ret = "";
    if (hrs > 0) {
        ret += "" + hrs + " h " + (mins < 10 ? "0" : "");
    }
    ret += "" + mins + " m " + (secs < 10 ? "0" : "");
    ret += "" + secs + " s";
    return ret;
  }
}
