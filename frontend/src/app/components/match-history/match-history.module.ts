import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { MatchComponent } from './match/match.component';
import { TeamsComponent } from './teams/teams.component';
import { TeamComponent } from './team/team.component';
import { KdaComponent } from './kda/kda.component';
import { ItemsComponent } from './items/items.component';
import { PlayerComponent } from './player/player.component';
import { SetupComponent } from './setup/setup.component';
import { RouterModule } from '@angular/router';


@NgModule({
  declarations: [    
    MatchComponent,
    TeamsComponent,
    TeamComponent,
    KdaComponent,
    ItemsComponent,
    PlayerComponent,
    SetupComponent,
  ],
  imports: [
    CommonModule,
    RouterModule
  ],
  exports: [
    MatchComponent,
    TeamsComponent,
    TeamComponent,
    KdaComponent,
    ItemsComponent,
    PlayerComponent,
    SetupComponent,
  ]
})
export class MatchHistoryModule { }
