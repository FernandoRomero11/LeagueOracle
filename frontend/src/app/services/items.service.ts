import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ItemsService {

  PHP_API_SERVER='http://localhost';

  constructor(private http: HttpClient) { }

  getItems(): Observable<any[]>{
    return this.http.get<any[]>(`${this.PHP_API_SERVER}/backend/getItems.php`)
  }

  getItemInfo(itemId: number): Observable<any[]>{
    return this.http.get<any[]>(`${this.PHP_API_SERVER}/backend/getItemInfo.php?itemId=${itemId}`)
  }
}
