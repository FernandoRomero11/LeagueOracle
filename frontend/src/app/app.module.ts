import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppRoutingModule } from './app-routing.module';
import { PagesModule } from './pages/pages.module';
import { AuthModule } from './auth/auth.module';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { Nopage404Component } from './nopage404/nopage404.component';

@NgModule({
  declarations: [
    AppComponent,
    Nopage404Component,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    PagesModule,
    AuthModule,
    HttpClientModule
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
