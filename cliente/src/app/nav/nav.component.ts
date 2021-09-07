import { Component, OnInit } from '@angular/core';
import {items} from '../items';

@Component({
  selector: 'mas-nav',
  templateUrl: './nav.component.html',
  styles: [
  ]
})
export class NavComponent implements OnInit {

  items = items;

  constructor() { }

  ngOnInit(): void {
  }

}
