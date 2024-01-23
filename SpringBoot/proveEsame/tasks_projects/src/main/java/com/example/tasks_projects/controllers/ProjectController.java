package com.example.tasks_projects.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.tasks_projects.data.ProjectRepository;
import com.example.tasks_projects.models.Project;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/projects")
@Controller
public class ProjectController {

    private ProjectRepository projectRepository; 
    
    public ProjectController(ProjectRepository projectRepository){
        this.projectRepository = projectRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Project> projects = projectRepository.findAll();
        model.addAttribute("projects", projects);
        return "project/index";
    }

    @GetMapping("/create")
    public String create() {
        return "project/create";
    }

    @PostMapping
    public String store(Project project) {
        projectRepository.save(project);
        return "redirect:/projects";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Project project = projectRepository.findById(id).orElse(null);
        model.addAttribute("project", project);
        return "project/show";
    }

    @PostMapping("/{id}")
    public String update(Project project) {
        projectRepository.save(project);
        return "redirect:/projects/"+project.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Project project = projectRepository.findById(id).orElse(null);
        projectRepository.delete(project);
        return "redirect:/projects";
    }
    
}
