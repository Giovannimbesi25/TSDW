package com.example.projects.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.projects.data.ProjectRepository;
import com.example.projects.models.Project;

@Controller
@RequestMapping("/projects")
public class ProjectController {

    @Autowired
    private ProjectRepository projectRepository;


    @GetMapping
    public String index(Model model){
        model.addAttribute("projects", projectRepository.findAll());
        return "projects";
    }

    @PostMapping
    public String store(Project project){
        projectRepository.save(project);
        return "redirect:/projects";
    }

    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id){
        Project project = projectRepository.findById(id).orElse(null);
        model.addAttribute("project", project);
        return "project";
    }

    @PostMapping("/{id}")
    public String update(Project project, Model model){
        projectRepository.save(project);
        return "redirect:/projects/"+project.getId();
    }


    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id){
        Project project = projectRepository.findById(id).orElse(null);
        projectRepository.delete(project);
        return "redirect:/projects";
    }
}
