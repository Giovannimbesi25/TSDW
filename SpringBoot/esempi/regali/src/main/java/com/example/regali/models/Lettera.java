package com.example.regali.models;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity
public class Lettera {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    private String nome;
    private Integer quantità;
    private Integer consegnata;

    public Lettera(){}

    public Lettera(String nome, Integer quantità){
        this.nome = nome;
        this.quantità = quantità;
        this.consegnata = 0;
    }

    public String getNome(){
        return nome;
    }

    public Integer getQuantità(){
        return quantità;
    }

    public Integer getConsegnata(){
        return consegnata;
    }

    public Long getId(){
        return id;
    }

    public void setId(Long id){
        this.id = id;
    }

    public void setNome(String nome){
        this.nome = nome;
    }

    public void setQuantità(Integer quantità){
        this.quantità = quantità;
    }

    public void setConsegnata(Integer consegnata){
        this.consegnata = consegnata;
    }

}
