package edu.unict.tswd.springboot.student.controllers;

import edu.unict.tswd.springboot.student.data.StudentRepository;
import edu.unict.tswd.springboot.student.models.Student;

import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.*;
import org.springframework.ui.Model;



@Controller
@RequestMapping("/students")
public class StudentController {

    @Autowired
    private final StudentRepository studentRepository;

    public StudentController(StudentRepository studentRepository) {
        this.studentRepository = studentRepository;
    }

    @GetMapping
    public String getAllStudents(Model model) {
        model.addAttribute("students", studentRepository.findAll());
        return "students"; 
    }

    @PostMapping("/age")
    public String getStudentsWithAge(@RequestParam Integer age, Model model){
        
        List<Student> students = studentRepository.findByAge(age);
        model.addAttribute("students", students);
        return "students";
    }

    @GetMapping("/doubleAge/{id}")
    public String doubleAge(@PathVariable Long id,  Model model) {
        Optional<Student> studentOptional = studentRepository.findById(id)  ;      
        if (studentOptional.isPresent()) {
            Student student = studentOptional.get();
            student.setAge(student.getAge() * 2);
            studentRepository.save(student);
        }

        model.addAttribute("student", "student");
        return "student";
    }
    

    @PostMapping("/addStudent")
    public String addStudent(@RequestParam String name,@RequestParam String surname, @RequestParam Integer age, Model model) {
        Student student = new Student(name,surname, age);
        studentRepository.save(student);
        return "redirect:/students";
    }


    @PostMapping("/findByNameAndSurname")
    public String findByNameAndSurname(@RequestParam String name, @RequestParam String surname, Model model) {
        List<Student> students = studentRepository.findByNameAndSurname(name, surname);        
        
        model.addAttribute("students", students);

        return "students";
    }
    
    
    @GetMapping("/{id}")
    public String  getStudent(@PathVariable Long id, Model model) {
        model.addAttribute("student", studentRepository.findById(id));
        return "student";
    }

    @PostMapping("/edit")
    public String editStudent(@ModelAttribute Student student) {
        studentRepository.save(student);
        return "redirect:/students/" + student.getId();
    }
    
    @GetMapping("/delete/{id}")
    public String postMethodName(@PathVariable Long id) {
        studentRepository.deleteById(id);

        return "redirect:/students";
    }
}