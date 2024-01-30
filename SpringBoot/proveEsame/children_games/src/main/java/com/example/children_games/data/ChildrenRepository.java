package com.example.children_games.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.children_games.models.Children;

public interface ChildrenRepository extends JpaRepository<Children, Long>{

    
}
