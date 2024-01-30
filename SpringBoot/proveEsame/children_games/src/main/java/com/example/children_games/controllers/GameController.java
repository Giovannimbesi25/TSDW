package com.example.children_games.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.children_games.data.ChildrenRepository;
import com.example.children_games.data.GameRepository;
import com.example.children_games.models.Children;
import com.example.children_games.models.Game;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/games")
@Controller
public class GameController {
    
    private GameRepository gameRepository;
    private ChildrenRepository childrenRepository;

    public GameController(ChildrenRepository childrenRepository, GameRepository gameRepository){
        this.gameRepository = gameRepository;
        this.childrenRepository = childrenRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Game> games = gameRepository.findAll();
        model.addAttribute("games", games);
        return "game/index";
    }

    @GetMapping("/create")
    public String create(Model model) {
        List<Children> childrens = childrenRepository.findAll();
        model.addAttribute("childrens", childrens);
        return "game/create";
    }


    @PostMapping
    public String store(Game game) {
        gameRepository.save(game);
        return "redirect:/games";
    }

    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id) {
        List<Children> childrens = childrenRepository.findAll();
        model.addAttribute("childrens", childrens);
        Game game = gameRepository.findById(id).orElse(null);
        model.addAttribute("game", game);
        return "game/show";
    }

    @PostMapping("/{id}")
    public String update(Game game) {
        gameRepository.save(game);
        return "redirect:/games/"+game.getId();
    }

    @PostMapping("delete/{id}")
    public String delete(@PathVariable Long id) {
        gameRepository.deleteById(id);
        return "redirect:/games";
    }


    @GetMapping("delete/all")
    public String deleteAll() {
        List<Game> games = gameRepository.findAll();
        for (Game game : games) {
            gameRepository.delete(game);
        }
        return "redirect:/games";
    }

    @GetMapping("/double")
    public String doubleAll() {
        gameRepository.doubleAll();
        return "redirect:/";
    }
    
}
