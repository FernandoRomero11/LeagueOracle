import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class SidebarService {

  menu: any[] = [
    {
      title: 'Dashboard',
      icon: 'mdi mdi-gauge',
      submenu: [
        { title: 'Home', url: '' },
        { title: 'Champions', url: 'champions' },
        { title: 'Items', url: 'items' },
        { title: 'Match-History', url: 'match-history' },
        { title: 'Favourite Players', url: 'favourite-players' }
      ]
    }
  ]

  constructor() { }
}
