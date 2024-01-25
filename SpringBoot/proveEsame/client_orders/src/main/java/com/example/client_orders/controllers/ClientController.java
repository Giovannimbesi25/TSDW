package com.example.client_orders.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.client_orders.data.ClientRepository;
import com.example.client_orders.models.Client;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;


@RequestMapping("/clients")
@Controller
public class ClientController {
    
    ClientRepository clientRepository;

    public ClientController(ClientRepository clientRepository){
        this.clientRepository = clientRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Client> clients = clientRepository.findAll();
        model.addAttribute("clients", clients);
        return "client/index";
    }

    @GetMapping("/create")
    public String create() {
        return "client/create";
    }

    @PostMapping
    public String store(Client client) {
        clientRepository.save(client);
        return "redirect:/clients";
    }

    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id) {
        Client client = clientRepository.findById(id).orElse(null);
        model.addAttribute("client", client);
        return "client/show";
    }

    @PostMapping("/{id}")
    public String update(Client client) {
        clientRepository.save(client);
        return "redirect:/clients/"+client.getId();
    }
    
    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        clientRepository.deleteById(id);
        return "redirect:/clients";
    }
}
