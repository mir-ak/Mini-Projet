import { Component, OnInit } from '@angular/core';

import { Article } from './articles';
import { NgForm, SelectMultipleControlValueAccessor } from '@angular/forms';
import { ArticleService } from './article.service';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title='client';
  articles: Article[] = [];
  article: Article = { title:'', description:'',published:"" };
  error='';
  success= '';
  constructor(private articleService: ArticleService) {}
  ngOnInit() {
    this.getArticles();
  }
  resetAlerts() {
    this.error = '';
  }
        
  getArticles(): void {
    this.articleService.getAll().subscribe(
      (data: Article[]) => {
        this.articles = data;
        //this.success = 'successful retrieval of the list';
      },
      (err) => {
        console.log(err);
        this.error = err;
      }
    );
  }

  addArticle(f: NgForm) {
    this.resetAlerts();
    console.log(this.article)
    this.articleService.add(this.article).subscribe(
      (res: Article) => {
        // Update the list of articles
        this.articles.push(res);
        // Inform the user
        this.success = 'Created successfully';
        // Reset the form
        f.reset();
      },
      (err) => (this.error = err.message)
    );
    window.setTimeout(function(){location.reload()},200)
  }

  updateArticle(id: any,title: any, description: any, published:any) {
    this.resetAlerts();
    this.articleService
      .update({ id: +id, title: title.value, description: description.value ,published: published.value})
      .subscribe(
        (res) => {
          this.success = 'Updated successfully';
        },
        (err) => (this.error = err)
      );
      window.setTimeout(function(){location.reload()},300)
  }

  deleteArticle(id: number) {
    this.resetAlerts();
    this.articleService.delete(id).subscribe(
      (res) => {
        this.success = 'Deleted successfully';
      },
      (err) => (this.error = err)
    );
    window.setTimeout(function(){location.reload()},300)
  }
  
  onItemChange(value:Boolean){
    if(value === true){
      this.article.published = "Oui";
    }else{
      this.article.published = "Non";
    }
    console.log(" Value is : ", this.article.published);
 }
}
