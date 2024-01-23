package com.example.authors_books.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.authors_books.models.Book;

public interface BookRepository extends JpaRepository<Book,Long>{
    
}
