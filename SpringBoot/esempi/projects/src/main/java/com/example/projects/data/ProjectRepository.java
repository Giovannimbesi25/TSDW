package com.example.projects.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.projects.models.Project;

public interface ProjectRepository extends JpaRepository<Project, Long>{
    
}
