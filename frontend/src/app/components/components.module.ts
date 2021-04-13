import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MatchHistoryModule } from './match-history/match-history.module';



@NgModule({
  declarations: [

  ],
  exports: [
    MatchHistoryModule
  ],
  imports: [
    CommonModule,
    MatchHistoryModule
  ]
})
export class ComponentsModule { }
