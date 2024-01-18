package com.example.magazzino.models;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Magazzino {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String nome;
    private Integer giacenza;
    private Double prezzo;

    public Magazzino(){}

    public Magazzino(String nome, Integer giacenza, Double prezzo){
        this.nome = nome;
        this.giacenza = giacenza;
        this.prezzo = prezzo;
    }

    public Long getId(){
        return this.id;
    }

    public String getNome(){
        return this.nome;
    }
    public Integer getGiacenza(){
        return this.giacenza;
    }
    public Double getPrezzo(){
        return this.prezzo;
    }

    public void setId(Long id){
        this.id = id;
    }
    public void setNome(String nomeProdotto){
        this.nome = nomeProdotto;
    }
    public void setGiacenza(Integer giacenza){
        this.giacenza = giacenza;
    }
    public void setPrezzo(Double prezzo){
        this.prezzo = prezzo;
    }

}
