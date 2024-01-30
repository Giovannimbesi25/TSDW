package com.example.children_games.models;

import org.hibernate.annotations.ManyToAny;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;

@Entity
public class Game {
    @ManyToOne
    @JoinColumn(name="children_id")
    private Children children;

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nomeGioco;
    private Double costo;

    
    public Children getChildren() {
        return children;
    }
    public void setChildren(Children children) {
        this.children = children;
    }
    public Long getId() {
        return id;
    }
    public void setId(Long id) {
        this.id = id;
    }
    public String getNomeGioco() {
        return nomeGioco;
    }
    public void setNomeGioco(String nomeGioco) {
        this.nomeGioco = nomeGioco;
    }
    public Double getCosto() {
        return costo;
    }
    public void setCosto(Double costo) {
        this.costo = costo;
    }
}
