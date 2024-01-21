package com.example.category_products.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.category_products.data.CategoryRepository;
import com.example.category_products.data.ProductRepository;
import com.example.category_products.models.Category;
import com.example.category_products.models.Product;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@Controller
@RequestMapping("/products")
public class ProductController {

    private CategoryRepository categoryRepository;
    private ProductRepository productRepository;

    public ProductController(CategoryRepository categoryRepository, ProductRepository productRepository){
        this.productRepository = productRepository;
        this.categoryRepository = categoryRepository;
    }

    @GetMapping()
    public String index(Model model) {
        List<Product> products = productRepository.findByGiacenzaGreaterThan(0);
        model.addAttribute("products", products);
        List<Category> categories = categoryRepository.findAll();
        model.addAttribute("categories", categories);

        return "products";
    }

    @PostMapping()
    public String store(Product product) {
        productRepository.save(product);
        return "redirect:/products";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Product product = productRepository.findById(id).orElse(null);
        List<Category> categories = categoryRepository.findAll();
        model.addAttribute("product", product);
        model.addAttribute("categories", categories);
        return "product";
    }

    @PostMapping("/{id}")
    public String update(Product product) {
        productRepository.save(product);
        return "redirect:/products/"+product.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(Product product) {
        productRepository.delete(product);
        return "redirect:/products";
    }
}
