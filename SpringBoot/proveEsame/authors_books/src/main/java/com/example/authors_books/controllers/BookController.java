package com.example.authors_books.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.authors_books.data.AuthorRepository;
import com.example.authors_books.data.BookRepository;
import com.example.authors_books.models.Author;
import com.example.authors_books.models.Book;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/books")
@Controller
public class BookController {

    private AuthorRepository authorRepository;
    private BookRepository bookRepository;

    public BookController(AuthorRepository authorRepository, BookRepository bookRepository){
        this.authorRepository = authorRepository;
        this.bookRepository = bookRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Book> books = bookRepository.findAll();
        model.addAttribute("books", books);
        List<Author> authors = authorRepository.findAll();
        model.addAttribute("authors", authors);
        return "book/books";
    }

    @GetMapping("/create/{authorId}")
    public String help_create(@PathVariable Long authorId, Model model) {
        List<Book> books = bookRepository.findAll();
        model.addAttribute("books", books);
        List<Author> authors = authorRepository.findAll();
        model.addAttribute("authors", authors);
        model.addAttribute("authorId", authorId);
        
        return "book/createBook";
    }

    @PostMapping
    public String store(Book book) {
        bookRepository.save(book);
        return "redirect:/books";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Book book = bookRepository.findById(id).orElse(null);
        model.addAttribute("book", book);
        List<Author> authors = authorRepository.findAll();
        model.addAttribute("authors", authors);
        return "book/book";
    }

    @PostMapping("/{id}")
    public String update(Book book) {
        bookRepository.save(book);
        return "redirect:/books/"+book.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Book book = bookRepository.findById(id).orElse(null);
        bookRepository.delete(book);
        return "redirect:/books";
    }
    
}
