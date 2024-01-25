package com.example.career_exams.data;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.career_exams.models.Exam;

public interface ExamRepository extends JpaRepository<Exam, Long>{
    
}
