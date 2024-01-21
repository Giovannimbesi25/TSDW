package com.example.players.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.players.models.Player;

public interface PlayerRepository extends JpaRepository<Player, Long>{
    
}
