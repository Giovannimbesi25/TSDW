package com.example.category_products.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.category_products.models.Category;

public interface CategoryRepository extends JpaRepository<Category, Long>{
    
}
