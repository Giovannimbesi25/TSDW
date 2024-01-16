package com.example.regali.data;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.regali.models.Lettera;

@Repository
public interface LetteraRepository extends JpaRepository<Lettera,Long>{
    public List<Lettera> findByConsegnata(Integer consegnata);
}
