import { Component } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/services/auth.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {

  public registerForm: FormGroup = new FormGroup({
    name: new FormControl('',Validators.required),
    email: new FormControl('',Validators.required),
    password: new FormControl('',Validators.required),
    password2: new FormControl('',Validators.required),
  })

  constructor(
    public authService: AuthService,
    private router: Router
  ) {}

  register() {
    const user = {
       email: this.registerForm.get('email').value, 
       password: this.registerForm.get('password').value
    };
    this.authService.register(user).subscribe(data => {
      console.log(data);
      this.router.navigateByUrl('/login');
    });
  }
}
