package com.example.client_orders.controllers;

import java.util.List;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestMapping;

import com.example.client_orders.data.ClientRepository;
import com.example.client_orders.data.OrdiniRepository;
import com.example.client_orders.models.Client;
import com.example.client_orders.models.Ordini;

@RequestMapping("/orders")
@Controller
public class OrdiniController {
    
    ClientRepository clientRepository;
    OrdiniRepository ordiniRepository;

    public OrdiniController(ClientRepository clientRepository, OrdiniRepository ordiniRepository){
        this.clientRepository = clientRepository;
        this.ordiniRepository = ordiniRepository;
    }

    @GetMapping
    public String index(Model model) {
        List<Ordini> orders = ordiniRepository.findAll();
        model.addAttribute("orders", orders);
        return "ordini/index";
    }

    @GetMapping("/create")
    public String create(Model model) {
        List<Client> clients = clientRepository.findAll();
        model.addAttribute("clients", clients);
        return "ordini/create";
    }

    @PostMapping
    public String store(Ordini ordini) {
        ordiniRepository.save(ordini);
        return "redirect:/orders";
    }

    @GetMapping("/{id}")
    public String show(Model model, @PathVariable Long id) {
        List<Client> clients = clientRepository.findAll();
        model.addAttribute("clients", clients);
        Ordini order = ordiniRepository.findById(id).orElse(null);
        model.addAttribute("order", order);
        return "ordini/show";
    }

    @PostMapping("/{id}")
    public String update(Ordini order) {
        ordiniRepository.save(order);
        return "redirect:/orders/"+order.getId();
    }
    
    @PostMapping("/delete/{id}")
    public String delete(@PathVariable Long id) {
        ordiniRepository.deleteById(id);
        return "redirect:/orders";
    }
}
