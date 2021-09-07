import { Component } from '@angular/core';
import {setTheme} from 'ngx-bootstrap/utils';

@Component({
  selector: 'mas-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'cliente';
  constructor() {
    setTheme('bs4');
  }
}
