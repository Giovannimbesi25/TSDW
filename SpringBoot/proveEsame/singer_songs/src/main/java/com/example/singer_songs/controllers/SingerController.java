package com.example.singer_songs.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.singer_songs.data.SingerRepository;
import com.example.singer_songs.models.Singer;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;



@Controller
@RequestMapping("/singers")
public class SingerController {
    
    SingerRepository singerRepository;
    public SingerController(SingerRepository singerRepository){
        this.singerRepository = singerRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Singer> singers = singerRepository.findAll();
        model.addAttribute("singers", singers);
        return "singer/index";
    }

    @GetMapping("/create")
    public String create() {
        return "singer/create";
    }

    @GetMapping("/searchBySong")
    public String searchBySong(@RequestParam String songName, Model model) {
        Singer singer = singerRepository.findBySongsNome(songName);
        model.addAttribute("singer", singer);
        return "singer/show";  
    }
    

    @PostMapping
    public String store(Singer singer) {
        System.out.println(singer.getNome());
        singerRepository.save(singer);
        return "redirect:/singers";
    }
    
    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id) {
        Singer singer = singerRepository.findById(id).orElse(null);
        System.out.println(singer.getSongs());
        model.addAttribute("singer", singer);
        return "singer/show";
    }
    
    @PostMapping("/{id}")
    public String update(Singer singer) {
        singerRepository.save(singer);
        return "redirect:/singers/"+singer.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        singerRepository.deleteById(id);
        return "redirect:/singers";
    }
}
