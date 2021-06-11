import { Routes, RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';

//import { AuthGuard } from '../guards/auth.guard';

import { PagesComponent } from './pages.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { ChampionsComponent } from './champions/champions.component';
import { ItemsComponent } from './items/items.component';
import { MatchHistoryComponent } from './match-history/match-history.component';
import { FavouritePlayersComponent } from './favourite-players/favourite-players.component';
import { ItemDetailComponent } from './item-detail/item-detail.component';
import { ChampionDetailComponent } from './champion-detail/champion-detail.component';
import { FindMatchHistoryComponent } from './find-match-history/find-match-history.component';
import { AuthGuardService } from '../services/auth-guard.service';


const routes: Routes = [
    { 
        path: 'dashboard', 
        component: PagesComponent,
        canActivate: [ AuthGuardService ],
        children: [
            { path: '', component: DashboardComponent, data: { title: 'Dashboard' }, pathMatch: 'full' },
            { path: 'champions/:id', component: ChampionDetailComponent, data: { title: 'Champion Detail' }},
            { path: 'champions', component: ChampionsComponent, data: { title: 'Champions' }},
            { path: 'items/:id', component: ItemDetailComponent, data: { title: 'Item Detail' }},
            { path: 'items', component: ItemsComponent, data: { title: 'Items' }},
            { path: 'match-history/:summonerName', component: MatchHistoryComponent, data: { title: 'Match History' }},
            { path: 'match-history', component: FindMatchHistoryComponent, data: { title: 'Match History' }},
            { path: 'favourite-players', component: FavouritePlayersComponent, data: { title: 'My favourite players' }},
        ]
    },
];

@NgModule({
    imports: [ RouterModule.forChild(routes) ],
    exports: [ RouterModule ]
})
export class PagesRoutingModule {}


