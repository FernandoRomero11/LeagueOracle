import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ChampionsService {

  PHP_API_SERVER='http://localhost';

  constructor(private http: HttpClient) { }

  getChampions(): Observable<any[]>{
    return this.http.get<any[]>(`${this.PHP_API_SERVER}/backend/getChampions.php`)
  }

  getChampionInfo(championId: string): Observable<any[]>{
    return this.http.get<any[]>(`${this.PHP_API_SERVER}/backend/getChampionInfo.php?championId=${championId}`)
  }
}
