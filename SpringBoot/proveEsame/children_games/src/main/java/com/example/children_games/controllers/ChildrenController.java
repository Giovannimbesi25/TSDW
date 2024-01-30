package com.example.children_games.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.children_games.data.ChildrenRepository;
import com.example.children_games.models.Children;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;

@RequestMapping("/childrens")
@Controller
public class ChildrenController {
    
    private ChildrenRepository childrenRepository;

    public ChildrenController(ChildrenRepository childrenRepository){
        this.childrenRepository = childrenRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Children> childrens = childrenRepository.findAll();
        model.addAttribute("childrens", childrens);
        return "children/index";
    }

    @GetMapping("/create")
    public String create() {
        return "children/create";
    }


    @PostMapping
    public String store(Children children) {
        childrenRepository.save(children);
        return "redirect:/childrens";
    }

    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id) {
        Children children = childrenRepository.findById(id).orElse(null);
        System.out.println(children.getGames());

        model.addAttribute("children", children);
        return "children/show";
    }

    @PostMapping("/{id}")
    public String update(Children children) {
        childrenRepository.save(children);
        return "redirect:/childrens/"+children.getId();
    }

    @PostMapping("delete/{id}")
    public String delete(@PathVariable Long id) {
        childrenRepository.deleteById(id);
        return "redirect:/childrens";
    }

    @GetMapping("delete/all")
    public String deleteAll() {
        List<Children> childrens = childrenRepository.findAll();
        for (Children children : childrens) {
            childrenRepository.delete(children);
        }
        return "redirect:/childrens";
    }

}
