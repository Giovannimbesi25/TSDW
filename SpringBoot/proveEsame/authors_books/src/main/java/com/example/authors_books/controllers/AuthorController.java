package com.example.authors_books.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.authors_books.data.AuthorRepository;
import com.example.authors_books.models.Author;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/authors")
@Controller
public class AuthorController {

    private AuthorRepository authorRepository;

    public AuthorController(AuthorRepository authorRepository){
        this.authorRepository = authorRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Author> authors = authorRepository.findAll();
        model.addAttribute("authors", authors);
        return "author/authors";
    }

    @PostMapping
    public String store(Author author) {
        authorRepository.save(author);
        return "redirect:/authors";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Author author  = authorRepository.findById(id).orElse(null);
        model.addAttribute("author", author);
        return "author/author";
    }

    @PostMapping("/{id}")
    public String update(Author author) {
        authorRepository.save(author);
        return "redirect:/authors/"+author.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Author author  = authorRepository.findById(id).orElse(null);
        authorRepository.delete(author);
        return "redirect:/authors";
    }   
    
}
