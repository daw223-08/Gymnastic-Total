import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DietasPredisenadasComponent } from './dietas-predisenadas.component';

describe('DietasPredisenadasComponent', () => {
  let component: DietasPredisenadasComponent;
  let fixture: ComponentFixture<DietasPredisenadasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DietasPredisenadasComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DietasPredisenadasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
