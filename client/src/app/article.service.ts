import { Injectable } from '@angular/core';

import { HttpClient, HttpParams } from '@angular/common/http';

import { map } from 'rxjs/operators';
import { Article } from './articles';

@Injectable({
  providedIn: 'root'
})

export class ArticleService {
  baseUrl = 'http://localhost:3000';
  constructor(private http: HttpClient) { }
  getAll() {
    return this.http.get(`${this.baseUrl}/get.php`).pipe(
      map((res: any) => {
        return res;
      })
    );
  }

  add(article: Article) {
    console.log(article);
    return this.http.post(`${this.baseUrl}/post.php`,{data: article},{responseType: 'text'}).pipe(
      map((res: any) => {
        return res['data'];
      })
    );
  }

  update(article: Article) {
    return this.http.put(`${this.baseUrl}/put.php`, {data: article});
  }

  delete(id: any) {
    const params = new HttpParams()
      .set('id', id.toString());
    return this.http.delete(`${this.baseUrl}/delete.php`, { params: params });
  }
}
