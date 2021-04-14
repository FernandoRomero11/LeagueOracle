import { NgModule } from '@angular/core';
import { MatchHistoryModule } from './match-history/match-history.module';



@NgModule({
  declarations: [

  ],
  exports: [
    MatchHistoryModule
  ],
  imports: [
    MatchHistoryModule
  ]
})
export class ComponentsModule { }
