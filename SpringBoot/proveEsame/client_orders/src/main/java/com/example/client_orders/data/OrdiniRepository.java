package com.example.client_orders.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.client_orders.models.Ordini;

public interface OrdiniRepository extends JpaRepository<Ordini, Long>{
    
}
