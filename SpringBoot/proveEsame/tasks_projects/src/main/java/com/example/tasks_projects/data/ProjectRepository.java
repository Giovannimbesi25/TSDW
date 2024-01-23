package com.example.tasks_projects.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.tasks_projects.models.Project;

public interface ProjectRepository extends JpaRepository<Project, Long>{
    
}
