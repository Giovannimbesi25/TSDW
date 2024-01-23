package com.example.authors_books.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.authors_books.models.Author;

public interface AuthorRepository extends JpaRepository<Author,Long>{
    
}
