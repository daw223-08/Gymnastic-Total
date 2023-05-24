import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MisDietasComponent } from './mis-dietas.component';

describe('MisDietasComponent', () => {
  let component: MisDietasComponent;
  let fixture: ComponentFixture<MisDietasComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MisDietasComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(MisDietasComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
