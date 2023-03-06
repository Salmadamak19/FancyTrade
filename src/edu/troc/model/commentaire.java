/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.model;

/**
 *
 * @author Nguira Azyz
 */
public class commentaire {
    private int id_com;
    private String com ;

    public commentaire() {
    }

    public commentaire( String com) {
        
        this.com = com;
    }

    public commentaire(int id_com, String com) {
        this.id_com = id_com;
        this.com = com;
    }

    public int getId_com() {
        return id_com;
    }

    public void setId_com(int id_com) {
        this.id_com = id_com;
    }

    public String getCom() {
        return com;
    }

    public void setCom(String com) {
        this.com = com;
    }

    @Override
    public String toString() {
        return "commentaire{" + "id_com=" + id_com + ", com=" + com + '}';
    }

    
}
