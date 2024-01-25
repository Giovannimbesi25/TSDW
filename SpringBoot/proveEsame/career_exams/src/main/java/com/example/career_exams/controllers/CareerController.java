package com.example.career_exams.controllers;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.career_exams.data.CareerRepository;
import com.example.career_exams.models.Career;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/careers")
@Controller
public class CareerController {
    @Autowired
    private CareerRepository careerRepository;

    public CareerController(CareerRepository careerRepository){
        this.careerRepository = careerRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Career> careers = careerRepository.findAll();
        model.addAttribute("careers", careers);
        return "career/index";
    }

    @GetMapping("/create")
    public String create() {
        return "career/create";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Career career = careerRepository.findById(id).orElse(null);
        model.addAttribute("career", career);
        return "career/show";
    }

    @PostMapping
    public String store(Career career) {
        careerRepository.save(career);
        return "redirect:/careers";
    }

    @PostMapping("/{id}")
    public String update(Career career) {
        careerRepository.save(career);
        return "redirect:/careers/"+career.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        careerRepository.deleteById(id);
        return "redirect:/careers";
    }

    @GetMapping("/deleteAll")
    public String deleteAllCareers() {
        List<Career> careers = careerRepository.findAll();
        for (Career career : careers) {
            careerRepository.delete(career);
        }
        return "redirect:/careers";
    }
    
}
