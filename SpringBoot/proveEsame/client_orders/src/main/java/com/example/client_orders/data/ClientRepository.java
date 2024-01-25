package com.example.client_orders.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.client_orders.models.Client;

public interface ClientRepository extends JpaRepository<Client, Long>{
    
}
