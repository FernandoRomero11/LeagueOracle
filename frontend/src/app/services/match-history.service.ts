import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MatchHistoryService {

  PHP_API_SERVER='http://localhost';

  constructor(private http: HttpClient) { }

  getMatchs(summonerName: string, init: number, end: number): Observable<any[]>{
    return this.http.get<any[]>(`${this.PHP_API_SERVER}/backend/getMatchs.php?summonerName=${summonerName}&init=${init}&end=${end}`)
  }
}
