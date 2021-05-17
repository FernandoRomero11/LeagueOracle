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
import { ItemDetailComponent } from './item-detail/item-detail.component';
import { ChampionDetailComponent } from './champion-detail/champion-detail.component';
import { FindMatchHistoryComponent } from './find-match-history/find-match-history.component'
import { FormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';
import { NgxSpinnerModule } from 'ngx-spinner';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { InterceptorService } from '../services/interceptor.service';

@NgModule({
  declarations: [
    MatchHistoryComponent,
    ItemsComponent,
    ChampionsComponent,
    FavouritePlayersComponent,
    PagesComponent,
    DashboardComponent,
    ItemDetailComponent,
    ChampionDetailComponent,
    FindMatchHistoryComponent,
  ],
  exports: [
    MatchHistoryComponent,
    ItemsComponent,
    ChampionsComponent,
    FavouritePlayersComponent,
    PagesComponent,
    DashboardComponent,
    ItemDetailComponent,
    ChampionDetailComponent,
    FindMatchHistoryComponent
  ],
  imports: [
    CommonModule,
    BrowserModule,
    SharedModule,
    RouterModule,
    ComponentsModule,
    FormsModule,
    NgxSpinnerModule
  ],
  providers: [
    { provide: HTTP_INTERCEPTORS, useClass: InterceptorService, multi: true }
  ]
})
export class PagesModule { }
