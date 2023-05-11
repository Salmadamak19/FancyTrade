package com.fancytrade.entities;

public class Reclamations {
    
    private int id,user_id,status;
    private ReclamationCategory reclamationsCategory;
     private String message;
     
    
    public Reclamations(int par,int user_id, ReclamationCategory makeAnimalsCategory, String message) {}

    
    public Reclamations(int id, ReclamationCategory AnimalsCategory, int  iduser, int  stat, String msg ) {
        this.id = id;
        this.reclamationsCategory = AnimalsCategory;
        this.user_id = iduser;
        this.status = stat;
        this.message = msg;
    }

     public Reclamations(ReclamationCategory AnimalsCategory, int  iduser, int  stat, String msg ) {
        this.reclamationsCategory = AnimalsCategory;
        this.user_id = iduser;
        this.status = stat;
        this.message = msg;
    }
     public Reclamations(int id,ReclamationCategory AnimalsCategory, int  iduser, String msg ) {
          this.id = id;
        this.reclamationsCategory = AnimalsCategory;
        this.user_id = iduser;
      
        this.message = msg;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }
    
    public ReclamationCategory getReclamationsCategory() {
        return reclamationsCategory;
    }

    public void setReclamationsCategory(ReclamationCategory AnimalsCategory) {
        this.reclamationsCategory = AnimalsCategory;
    }

    public int getUser_id() {
        return user_id;
    }

    public void setUser_id(int user_id) {
        this.user_id = user_id;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }
    
    

    
    
    
}