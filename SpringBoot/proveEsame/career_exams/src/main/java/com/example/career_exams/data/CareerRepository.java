package com.example.career_exams.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.career_exams.models.Career;

public interface CareerRepository extends JpaRepository<Career,Long>{
    
}
