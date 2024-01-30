package com.example.children_games.data;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.children_games.models.Game;

public interface GameRepository extends JpaRepository<Game, Long>{

    default void doubleAll(){
        List<Game> games = this.findAll();
        for (Game game : games) {
            game.setCosto(game.getCosto()*2);
            this.save(game);
        }
    }
}
