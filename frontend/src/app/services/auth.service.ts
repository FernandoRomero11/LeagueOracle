import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  public baseUrl = "http://localhost/backend/CRUD";
  private loggedUserSubject: BehaviorSubject<any>;
  public loggedInUser: Observable<any>;

  constructor(private http: HttpClient) {
    this.loggedUserSubject = new BehaviorSubject(this.getLoggedUser);
    this.loggedInUser = this.loggedUserSubject.asObservable();
  }

  login(user: { email: string, password: string }): Observable<any> {
    console.log(user);
    return this.http.post<any>(`http://localhost/backend/CRUD/postSignIn.php`, user)
        .pipe(map(response=> {
          console.log(response);
            localStorage.setItem('loggedInUser', JSON.stringify(response));
            this.loggedUserSubject.next(response);
            return response;
        }));
  }

  logout(): void {
    localStorage.removeItem('loggedInUser');
    this.loggedUserSubject.next(null);
  }

  get loggedInUserValue(){
    return this.loggedUserSubject.value;
  }

  get getLoggedUser(){
    return JSON.parse(localStorage.getItem('loggedInUser'));
  } 


  register(user: any): Observable<any> {
    return this.http.post("https://reqres.in/api/register", user);
  }

  public isLogged(): boolean {
    const userLogged = this.getLoggedUser;
    const actual = new Date().getTime();
    if(actual < userLogged.expiry){
      localStorage.removeItem('loggedInUser');
      return false;
    }
    return true;
  }

/* 
  login(user: any): Observable<any> {
    return this.http.post("https://reqres.in/api/login", user);
  }



  setToken(token: string): void {
    this.cookies.set("token", token);
  }

  getToken(): string {
    return this.cookies.get("token");
  }

  getUser(): Observable<any> {
    return this.http.get("https://reqres.in/api/users/2");
  }

  getUserLogged(): void {
    const token = this.getToken();
    // Aquí iría el endpoint para devolver el usuario para un token
  }

  logout(): void{
    this.cookies.delete("token");
  } */
}
