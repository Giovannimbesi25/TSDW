package com.example.players.controllers;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.players.data.TeamRepository;
import com.example.players.models.Team;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;



@Controller
@RequestMapping("/teams")
public class TeamController {
    
    @Autowired
    private TeamRepository teamRepository;

    @GetMapping
    public String index(Model model) {
        List<Team> teams = teamRepository.findAll();
        model.addAttribute("teams", teams);
        return "teams";
    }

    @PostMapping
    public String store(Team team) {
        teamRepository.save(team);
        return "redirect:/teams";
    }


    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Team team = teamRepository.findById(id).orElse(null);
        model.addAttribute("team", team);
        return "team";
    }


    @PostMapping("/{id}")
    public String update(Team team) {
        teamRepository.save(team);
        return "redirect:/teams/"+team.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        teamRepository.deleteById(id);
        return "redirect:/teams";
    }
    
}
