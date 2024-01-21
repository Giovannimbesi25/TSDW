package com.example.category_products.data;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.category_products.models.Product;

public interface ProductRepository extends JpaRepository<Product, Long>{
    public List<Product> findByGiacenzaGreaterThan(Integer giacenza);
}
