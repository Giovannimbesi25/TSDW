package edu.unict.tswd.springboot.student.data;

import edu.unict.tswd.springboot.student.models.Student;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;


@Repository
public interface StudentRepository extends JpaRepository<Student,Long> {
    List<Student> findByAge(Integer maxAge);
    List<Student> findByName(String name);
    List<Student> findByNameAndSurname(String name, String surname);
}