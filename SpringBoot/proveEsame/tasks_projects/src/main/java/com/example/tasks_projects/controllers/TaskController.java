package com.example.tasks_projects.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;

import com.example.tasks_projects.data.ProjectRepository;
import com.example.tasks_projects.data.TaskRepository;
import com.example.tasks_projects.models.Project;
import com.example.tasks_projects.models.Task;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/tasks")
@Controller
public class TaskController {

    private ProjectRepository projectRepository;
    private TaskRepository taskRepository; 
    
    public TaskController(ProjectRepository projectRepository, TaskRepository taskRepository){
        this.projectRepository = projectRepository;
        this.taskRepository = taskRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Task> tasks = taskRepository.findAll();
        model.addAttribute("tasks", tasks);
        return "task/index";
    }   

    @GetMapping("/create")
    public String create(Model model) {
        List<Project> projects = projectRepository.findAll();
        model.addAttribute("projects", projects);
        return "task/create";
    }

    @PostMapping
    public String store(Task task) {
        taskRepository.save(task);
        return "redirect:/tasks";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        Task task = taskRepository.findById(id).orElse(null);
        List<Project> projects = projectRepository.findAll();
        model.addAttribute("projects", projects);
        model.addAttribute("task", task);
        return "task/show";
    }

    @PostMapping("/{id}")
    public String update(Task task) {
        taskRepository.save(task);
        return "redirect:/tasks/"+task.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        Task task = taskRepository.findById(id).orElse(null);
        taskRepository.delete(task);
        return "redirect:/tasks";
    }

    @PostMapping("/deleteFromProject/{id}")
    public String deleteFromProject(@PathVariable Long id, @RequestParam Long projectId) {
        Task task = taskRepository.findById(id).orElse(null);
        taskRepository.delete(task);
        return "redirect:/projects/"+projectId;
    }
}
