package com.example.tasks_projects.models;

import java.util.List;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.OneToMany;

@Entity
public class Project {

    @OneToMany(cascade = CascadeType.ALL)    
    @JoinColumn(name = "project_id")
    private List<Task> tasks;

    public List<Task> getTasks() {
        return tasks;
    }
    public void setTasks(List<Task> tasks) {
        this.tasks = tasks;
    }


    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;


    public Long getId() {
        return id;
    }
    public void setId(Long id) {
        this.id = id;
    }


    private String nome;


    public String getNome() {
        return nome;
    }
    public void setNome(String nome) {
        this.nome = nome;
    }


    private String tipologia;


    public String getTipologia() {
        return tipologia;
    }
    public void setTipologia(String tipologia) {
        this.tipologia = tipologia;
    }


    private Integer creazione;


    public Integer getCreazione() {
        return creazione;
    }
    public void setCreazione(Integer creazione) {
        this.creazione = creazione;
    }
    

    
}
