package com.fancytrade.entities;

public class ReclamationCategory  {
    
    private int id;
     private String nom;
     
    
    public ReclamationCategory() {}

    public ReclamationCategory(int id, String nom) {
        this.id = id;
        this.nom = nom;
    }

    public ReclamationCategory(String nom) {
       this.nom = nom;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
    
    public String getNom() {
        return nom;
    }

    public void setNom(String nom) {
        this.nom = nom;
    }
    
  
    
    
    
    
    @Override
    public String toString() {
        return "ReclamationCategory : " +
                "id=" + id
                 + ", nom=" + nom
                
                ;
    }
    




}