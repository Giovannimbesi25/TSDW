package com.example.client_orders.models;

import java.util.List;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.OneToMany;

@Entity
public class Client {

    @OneToMany(cascade = CascadeType.REMOVE)
    @JoinColumn(name = "client_id")
    private List<Ordini> orders;

    
    public List<Ordini> getOrders() {
        return orders;
    }
    public void setOrders(List<Ordini> orders) {
        this.orders = orders;
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
    private String cognome;
    public String getCognome() {
        return cognome;
    }
    public void setCognome(String cognome) {
        this.cognome = cognome;
    }
    private Integer età;
    public Integer getEtà() {
        return età;
    }
    public void setEtà(Integer età) {
        this.età = età;
    }
}
