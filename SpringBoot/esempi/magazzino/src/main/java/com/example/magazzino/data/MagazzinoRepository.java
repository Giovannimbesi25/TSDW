package com.example.magazzino.data;

import org.springframework.data.jpa.repository.JpaRepository;
import java.util.List;
import com.example.magazzino.models.Magazzino;

public interface MagazzinoRepository extends JpaRepository<Magazzino, Long>{
    public List<Magazzino> findByGiacenzaGreaterThan(Integer giacenza);
}
