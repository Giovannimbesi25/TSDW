package com.example.category_products.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.category_products.data.CategoryRepository;
import com.example.category_products.models.Category;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@Controller
@RequestMapping("/categories")
public class CategoryController {

    private CategoryRepository categoryRepository;

    public CategoryController(CategoryRepository categoryRepository){
        this.categoryRepository = categoryRepository;
    }
    @GetMapping()
    public String index(Model model) {
        List<Category> categories = categoryRepository.findAll();
        model.addAttribute("categories", categories);
        return "categories";
    }

    @PostMapping()
    public String store(Category category) {
        categoryRepository.save(category);
        return "redirect:/categories";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Category category = categoryRepository.findById(id).orElse(null);
        model.addAttribute("category", category);
        return "category";
    }

    @PostMapping("/{id}")
    public String update(Category category) {
        categoryRepository.save(category);
        return "redirect:/categories/"+category.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(Category category) {
        categoryRepository.delete(category);
        return "redirect:/categories";
    }
    

}
