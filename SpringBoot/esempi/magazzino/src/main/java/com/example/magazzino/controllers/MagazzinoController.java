package com.example.magazzino.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.magazzino.data.MagazzinoRepository;
import com.example.magazzino.models.Magazzino;
import java.util.List;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@Controller
@RequestMapping("/prodotti")
public class MagazzinoController {

    @Autowired
    private MagazzinoRepository magazzinoRepository;

    @GetMapping
    public String index(Model model) {
        List<Magazzino> prodotti = magazzinoRepository.findByGiacenzaGreaterThan(0);
        model.addAttribute("prodotti", prodotti);
        return "prodotti";
    }

    @PostMapping
    public String store(Magazzino magazzino) {
        magazzinoRepository.save(magazzino);
        return "redirect:/prodotti";
    }

    @PostMapping("/compra/{id}")
    public String update(@PathVariable Long id) {
        Magazzino magazzino = magazzinoRepository.findById(id).orElse(null);
        magazzino.setGiacenza(magazzino.getGiacenza() - 1);
        magazzinoRepository.save(magazzino);
        
        return "redirect:/prodotti";
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Magazzino magazzino = magazzinoRepository.findById(id).orElse(null);
        magazzinoRepository.delete(magazzino);
        return "redirect:/prodotti";
    }
    
}
