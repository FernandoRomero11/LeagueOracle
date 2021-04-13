import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { SharedModule } from '../shared/shared.module';
import { ComponentsModule } from '../components/components.module';

import { MatchHistoryComponent } from './match-history/match-history.component';
import { ItemsComponent } from './items/items.component';
import { ChampionsComponent } from './champions/champions.component';
import { FavouritePlayersComponent } from './favourite-players/favourite-players.component';
import { PagesComponent } from './pages.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { RouterModule } from '@angular/router';
import { ItemDetailComponent } from './item-detail/item-detail.component'

@NgModule({
  declarations: [
    MatchHistoryComponent,
    ItemsComponent,
    ChampionsComponent,
    FavouritePlayersComponent,
    PagesComponent,
    DashboardComponent,
    ItemDetailComponent
  ],
  exports: [
    MatchHistoryComponent,
    ItemsComponent,
    ChampionsComponent,
    FavouritePlayersComponent,
    PagesComponent,
    DashboardComponent,
    ItemDetailComponent
  ],
  imports: [
    CommonModule,
    SharedModule,
    RouterModule,
    ComponentsModule
  ]
})
export class PagesModule { }
