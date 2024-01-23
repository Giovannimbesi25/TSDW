package com.example.tasks_projects.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.tasks_projects.models.Task;

public interface TaskRepository extends JpaRepository<Task, Long>{
    
}
