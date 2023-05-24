import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditarDietaComponent } from './editar-dieta.component';

describe('EditarDietaComponent', () => {
  let component: EditarDietaComponent;
  let fixture: ComponentFixture<EditarDietaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ EditarDietaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(EditarDietaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
