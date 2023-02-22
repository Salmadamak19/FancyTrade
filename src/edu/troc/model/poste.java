/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.model;

import edu.troc.interfaces.InterfaceCRUD;
import java.sql.Date;

/**
 *
 * @author belkn
 */
public class poste {

   private int id_poste ; 
   private String date_publication ;
   private String photo,region,categorie,description ; 
   private int valeur ; 
   private String titre ;

    public poste() {
    }

    public poste(String date_publication, String photo, String region, String categorie, String description, int valeur, String titre) {
        this.date_publication = date_publication;
        this.photo = photo;
        this.region = region;
        this.categorie = categorie;
        this.description = description;
        this.valeur = valeur;
        this.titre = titre;
    }

    public poste(int id_poste, String date_publication, String photo, String region, String categorie, String description, int valeur, String titre) {
        this.id_poste = id_poste;
        this.date_publication = date_publication;
        this.photo = photo;
        this.region = region;
        this.categorie = categorie;
        this.description = description;
        this.valeur = valeur;
        this.titre = titre;
    }

 

    public int getId_poste() {
        return id_poste;
    }

    public void setId_poste(int id_poste) {
        this.id_poste = id_poste;
    }

    public String getDate_publication() {
        return date_publication;
    }

    public void setDate_publication(String date_publication) {
        this.date_publication = date_publication;
    }

    public String getPhoto() {
        return photo;
    }

    public void setPhoto(String photo) {
        this.photo = photo;
    }

    public String getRegion() {
        return region;
    }

    public void setRegion(String region) {
        this.region = region;
    }

    public String getCategorie() {
        return categorie;
    }

    public void setCategorie(String categorie) {
        this.categorie = categorie;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getValeur() {
        return valeur;
    }

    public void setValeur(int valeur) {
        this.valeur = valeur;
    }

    public String getTitre() {
        return titre;
    }

    public void setTitre(String titre) {
        this.titre = titre;
    }

    @Override
    public String toString() {
        return  "id_poste=" + id_poste + ", date_publication=" + date_publication + ", photo=" + photo + ", region=" + region + ", categorie=" + categorie + ", description=" + description + ", valeur=" + valeur + ", titre=" + titre + '}';
    }
   
   

    

}
