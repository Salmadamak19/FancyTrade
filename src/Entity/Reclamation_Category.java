/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entity;

/**
 *
 * @author fairouzkhayat
 */
 public class Reclamation_Category {
    
    private String id;
    private String name;
    private String description;

    public Reclamation_Category() {
    }

    public Reclamation_Category(String name, String description) {
        this.name = name;
        this.description = description;
    }

    public Reclamation_Category(String id, String name, String description) {
        this.id = id;
        this.name = name;
        this.description = description;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }
}
   

