package com.example.career_exams.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.career_exams.data.CareerRepository;
import com.example.career_exams.data.ExamRepository;
import com.example.career_exams.models.Career;
import com.example.career_exams.models.Exam;


import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/exams")
@Controller
public class ExamController {

    private ExamRepository examRepository;
    private CareerRepository careerRepository;

    public ExamController(CareerRepository careerRepository, ExamRepository examRepository){
        this.careerRepository = careerRepository;
        this.examRepository = examRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Exam> exams = examRepository.findAll();
        model.addAttribute("exams", exams);
        return "exam/index";
    }

    @GetMapping("/create")
    public String create(Model model) {
        List<Career> careers = careerRepository.findAll();
        model.addAttribute("careers", careers);
        return "exam/create";
    }

    @GetMapping("/{id}")
    public String show(@PathVariable Long id, Model model) {
        List<Career> careers = careerRepository.findAll();
        model.addAttribute("careers", careers);
        Exam exam = examRepository.findById(id).orElse(null);
        model.addAttribute("exam", exam);
        return "exam/show";
    }


    @PostMapping("/{id}")
    public String update(Exam exam) {
        examRepository.save(exam);
        return "redirect:/exams/"+exam.getId();
    }

    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        examRepository.deleteById(id);
        return "redirect:/exams";
    }

    @PostMapping
    public String store(Exam exam) {
        examRepository.save(exam);
        return "redirect:/exams";
    }

    @GetMapping("/deleteAll")
    public String deleteAllExams() {
        List<Exam> exams = examRepository.findAll();
        for (Exam exam : exams) {
            examRepository.delete(exam);
        }
        return "redirect:/exams";
    }
    
}
