package com.example.regali.controllers;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.regali.data.LetteraRepository;
import com.example.regali.models.Lettera;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.PostMapping;



@Controller
@RequestMapping("/lettere")
public class LetteraController {
    
    @Autowired
    public final LetteraRepository letteraRepository;
    
    public LetteraController(LetteraRepository letteraRepository){
        this.letteraRepository = letteraRepository;
    }

    @GetMapping
    public String getMethodName(Model model) {
        List<Lettera> lettere = letteraRepository.findByConsegnata(0);
        model.addAttribute("lettere", lettere);
        return "lettere";
    }

    @GetMapping("/about/{id}")
    public String about(@PathVariable Long id, Model model) {
        Optional<Lettera> letteraOptional = letteraRepository.findById(id);
        if(letteraOptional.isPresent()){
            Lettera lettera = letteraOptional.get();
            model.addAttribute("lettera", lettera);
            return "lettera";
        }

        return "redirect:/lettere";
    }

    @PostMapping("/update")
    public String update(@ModelAttribute Lettera lettera) {
        letteraRepository.save(lettera);

        return "redirect:/lettere/about/"+lettera.getId();
    }

    @PostMapping("/aggiungiLettera")
    public String aggiungiLettera(@RequestParam String nome, @RequestParam Integer quantità) {
        Lettera lettera = new Lettera(nome,quantità);
        letteraRepository.save(lettera);
        return "redirect:/lettere";
    }


    @PostMapping("/consegna/{id}")
    public String consegna(@PathVariable Long id) {
        Optional<Lettera> letteraOptional = letteraRepository.findById(id);
        if(letteraOptional.isPresent()){
            Lettera lettera = letteraOptional.get();
            lettera.setConsegnata(1);
            letteraRepository.save(lettera);
        }
        
        return "redirect:/lettere";
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        letteraRepository.deleteById(id);
        
        return "redirect:/lettere";
    }

    @GetMapping("/befana")
    public String befana() {
        List<Lettera> lettere = letteraRepository.findByConsegnata(0);
        for (Lettera lettera : lettere) {
            lettera.setQuantità(lettera.getQuantità()*2);
            letteraRepository.save(lettera);
        }
        return "redirect:/lettere";
    }
    
}
