package com.example.players.controllers;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.players.data.PlayerRepository;
import com.example.players.data.TeamRepository;
import com.example.players.models.Player;
import com.example.players.models.Team;


@Controller
@RequestMapping("/players")
public class PlayerController {
    

    private PlayerRepository playerRepository;
    private TeamRepository teamRepository;

    public PlayerController(PlayerRepository playerRepository, TeamRepository teamRepository){
        this.playerRepository = playerRepository;
        this.teamRepository = teamRepository;
    }

    @GetMapping()
    public String index(Model model) {
        List<Player> players = playerRepository.findAll();
        model.addAttribute("players", players);
        List<Team> teams = teamRepository.findAll();
        model.addAttribute("teams", teams);
        return "players";
    }

    @PostMapping()
    public String store(Player player) {
        playerRepository.save(player);
        return "redirect:/players";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Player player = playerRepository.findById(id).orElse(null);
        model.addAttribute("player", player);
        List<Team> teams = teamRepository.findAll();
        model.addAttribute("teams", teams);
        return "player";
    }

    @PostMapping("/{id}")
    public String update(Player player, Model model) {
        playerRepository.save(player);
        return "redirect:/players/"+player.getId();
    }


    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Player player = playerRepository.findById(id).orElse(null);
        playerRepository.delete(player);
        return "redirect:/players";
    }
    
}
