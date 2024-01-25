package com.example.singer_songs.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.singer_songs.data.SingerRepository;
import com.example.singer_songs.data.SongRepository;
import com.example.singer_songs.models.Singer;
import com.example.singer_songs.models.Song;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@Controller
@RequestMapping("/songs")
public class SongController {
    
    SingerRepository singerRepository;
    SongRepository songRepository;
    public SongController(SingerRepository singerRepository, SongRepository songRepository){
        this.singerRepository = singerRepository;
        this.songRepository = songRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Song> songs = songRepository.findAll();
        model.addAttribute("songs", songs);
        return "song/index";
    }

    @GetMapping("/create")
    public String create(Model model) {
        List<Singer> singers = singerRepository.findAll();
        model.addAttribute("singers", singers);
        return "song/create";
    }

    @PostMapping
    public String store(Song song) {
        songRepository.save(song);
        return "redirect:/songs";
    }

    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id) {
        Song song = songRepository.findById(id).orElse(null);
        List<Singer> singers = singerRepository.findAll();
        model.addAttribute("singers", singers);
        model.addAttribute("song", song);
        return "song/show";
    }
    
    @PostMapping("/{id}")
    public String update(Song song) {
        songRepository.save(song);
        return "redirect:/songs/"+song.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        songRepository.deleteById(id);
        return "redirect:/songs";
    }
    
    @GetMapping("/searchBySinger")
    public String searchBySinger(Model model, @RequestParam String nome, @RequestParam String cognome) {
        Singer singer = singerRepository.findByNomeOrCognome(nome, cognome);        
        model.addAttribute("songs", singer.getSongs());
        return "song/index";
    }
}
