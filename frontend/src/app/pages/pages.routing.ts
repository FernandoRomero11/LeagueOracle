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


const routes: Routes = [
    { 
        path: 'dashboard', 
        component: PagesComponent,
        //canActivate: [ AuthGuard ],
        children: [
            { path: '', component: DashboardComponent, data: { title: 'Dashboard' } },
            { path: 'champions', component: ChampionsComponent, data: { title: 'Champions' }},
            { path: 'champions/:id', component: ChampionDetailComponent, data: { title: 'Champion Detail' }},
            { path: 'items', component: ItemsComponent, data: { title: 'Items' }},
            { path: 'items/:id', component: ItemDetailComponent, data: { title: 'Item Detail' }},
            { path: 'match-history', component: MatchHistoryComponent, data: { title: 'Match History' }},
            { path: 'favourite-players', component: FavouritePlayersComponent, data: { title: 'My favourite players' }},
        ]
    },
];

@NgModule({
    imports: [ RouterModule.forChild(routes) ],
    exports: [ RouterModule ]
})
export class PagesRoutingModule {}


