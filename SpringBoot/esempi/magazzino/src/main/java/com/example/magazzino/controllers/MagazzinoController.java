package com.example.magazzino.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.magazzino.data.MagazzinoRepository;
import com.example.magazzino.models.Magazzino;
import java.util.List;
import java.util.Optional;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;


@Controller
@RequestMapping("/prodotti")
public class MagazzinoController {

    @Autowired
    private MagazzinoRepository magazzinoRepository;

    public MagazzinoController(MagazzinoRepository magazzinoRepository){
        this.magazzinoRepository = magazzinoRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Magazzino> prodotti = magazzinoRepository.findByGiacenzaGreaterThan(0);
        model.addAttribute("prodotti", prodotti);
        
        return "prodotti";
    }

    @PostMapping
    public String store(@RequestParam String nome_prodotto, @RequestParam Integer giacenza, @RequestParam Double prezzo ) {
        Magazzino magazzino = new Magazzino(nome_prodotto, giacenza, prezzo);
        magazzinoRepository.save(magazzino);
        return "redirect:/prodotti";
    }

    @PostMapping("/compra/{id}")
    public String update(@PathVariable Long id) {
        Optional<Magazzino> magazzinoOptional = magazzinoRepository.findById(id);
        if(magazzinoOptional.isPresent()){
            Magazzino magazzino = magazzinoOptional.get();

            magazzino.setGiacenza(magazzino.getGiacenza() - 1);
            magazzinoRepository.save(magazzino);
        }
        
        return "redirect:/prodotti";
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Optional<Magazzino> magazzinoOptional = magazzinoRepository.findById(id);
        if(magazzinoOptional.isPresent()){
            Magazzino magazzino = magazzinoOptional.get();

            magazzinoRepository.delete(magazzino);
        }
        
        return "redirect:/prodotti";
    }
    
}
