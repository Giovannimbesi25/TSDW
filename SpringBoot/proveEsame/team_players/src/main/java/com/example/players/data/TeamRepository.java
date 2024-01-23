package com.example.players.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.players.models.Team;

public interface TeamRepository extends JpaRepository<Team, Long>{
    
}
