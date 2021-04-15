import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MatchComponent } from './match/match.component';
import { TeamsComponent } from './teams/teams.component';
import { TeamComponent } from './team/team.component';
import { KdaComponent } from './kda/kda.component';
import { ResultComponent } from './result/result.component';
import { PlayerComponent } from './player/player.component';
import { SetupComponent } from './setup/setup.component';


@NgModule({
  declarations: [    
    MatchComponent,
    TeamsComponent,
    TeamComponent,
    KdaComponent,
    ResultComponent,
    PlayerComponent,
    SetupComponent,
  ],
  imports: [
    CommonModule
  ],
  exports: [
    MatchComponent,
    TeamsComponent,
    TeamComponent,
    KdaComponent,
    ResultComponent,
    PlayerComponent,
    SetupComponent,
  ]
})
export class MatchHistoryModule { }
