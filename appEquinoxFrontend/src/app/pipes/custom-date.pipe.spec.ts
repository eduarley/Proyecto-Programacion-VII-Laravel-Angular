/*import { CustomDatePipe } from './custom-date.pipe';
describe('CustomDatePipe', () => {
  it('create an instance', () => {
    const pipe = new CustomDatePipe();
    expect(pipe).toBeTruthy();
  });
});*/


import { Pipe, PipeTransform } from '@angular/core';
import { DatePipe } from '@angular/common';

 @Pipe({
     name: 'fecha'
   })
   export class CustomDatePipe extends DatePipe implements PipeTransform {
        transform(value: any, args?: any): any {
        return super.transform(value, "dd MM yyyy");
     }
   }
