import { Injectable } from '@angular/core';
import {
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpInterceptor
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';

@Injectable()
export class AuthInterceptor implements HttpInterceptor {
  constructor(private authService: AuthService) { }
  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
      const loggedInUser = this.authService.loggedInUserValue;
      const token = JSON.parse(localStorage.getItem(loggedInUser.token));
      if (token) {
          request = request.clone({
              setHeaders: {
                  Authorization: `Bearer ${token}`
              }
          });
      }

      return next.handle(request);
  }
}
