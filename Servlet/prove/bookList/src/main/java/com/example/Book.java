package com.example;

public class Book {
  private String title;
  private String author;
  private String type;
  private String year;

  public Book(String title, String author, String type, String year){
    this.title = title;
    this.author = author;
    this.type = type;
    this.year = year;
  }

  public void setTitle(String title){
    this.title = title;
  }
  public void setAuthor(String author){
    this.author = author;
  }
  public void setType(String type){
    this.type = type;
  }
  public void setYear(String year){
    this.year = year;
  }


  public String getTitle(){
    return this.title;
  }
  public String getAuthor(){
    return this.author;
  }
  public String getType(){
    return this.type ;
  }
  public String getYear(){
    return this.year;
  }
}
