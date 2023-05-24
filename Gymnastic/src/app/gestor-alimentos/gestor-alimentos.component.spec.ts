import { ComponentFixture, TestBed } from '@angular/core/testing';

import { GestorAlimentosComponent } from './gestor-alimentos.component';

describe('GestorAlimentosComponent', () => {
  let component: GestorAlimentosComponent;
  let fixture: ComponentFixture<GestorAlimentosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ GestorAlimentosComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(GestorAlimentosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
