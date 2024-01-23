package com.example.authors_books.models;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;

@Entity

public class Book {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    public Long getId() {
        return id;
    }
    public void setId(Long id) {
        this.id = id;
    }

    @ManyToOne
    @JoinColumn(name="author_id")
    private Author author;

    public Author getAuthor() {
        return author;
    }
    public void setAuthor(Author author) {
        this.author = author;
    }

    private String titolo;
    public String getTitolo() {
        return titolo;
    }
    public void setTitolo(String titolo) {
        this.titolo = titolo;
    }
    private String genere;
    public String getGenere() {
        return genere;
    }
    public void setGenere(String genere) {
        this.genere = genere;
    }

    private Integer pubblicazione;
    public Integer getPubblicazione() {
        return pubblicazione;
    }
    public void setPubblicazione(Integer pubblicazione) {
        this.pubblicazione = pubblicazione;
    }

}
