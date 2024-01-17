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
    private String nome_prodotto;
    private Integer giacenza;
    private Double prezzo;

    public Magazzino(){}

    public Magazzino(String nome_prodotto, Integer giacenza, Double prezzo){
        this.nome_prodotto = nome_prodotto;
        this.giacenza = giacenza;
        this.prezzo = prezzo;
    }

    public Long getId(){
        return this.id;
    }

    public String getNomeProdotto(){
        return this.nome_prodotto;
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
    public void setNomeProdotto(String nomeProdotto){
        this.nome_prodotto = nomeProdotto;
    }
    public void setGiacenza(Integer giacenza){
        this.giacenza = giacenza;
    }
    public void setPrezzo(Double prezzo){
        this.prezzo = prezzo;
    }

}
