/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entities;

import java.sql.Date;

/**
 *
 * @author salma
 */

public class Post_forum {
    private int id;
    private String sujet;
    private String description;
    private String communaute;
    private String nom_user;
    private Date date_p;
    private String image;
     private int nbr_jaime;
    
static int test;

    public static int getTest() {
        return test;
    }

    public static void setTest(int test) {
        Post_forum.test = test;
    }
    public Post_forum() {
    }

    public Post_forum(String sujet, String description, String communaute, String nom_user, String image, int nbr_jaime) {
        this.sujet = sujet;
        this.description = description;
        this.communaute = communaute;
        this.nom_user = nom_user;
        this.image = image;
        this.nbr_jaime = nbr_jaime;
    }

    public Post_forum(int idPost, String sujet, String description, String communaute, String nom_user,  String image, int nbr_jaime) {
        this.id = idPost;
        this.sujet = sujet;
        this.description = description;
        this.communaute = communaute;
        this.nom_user = nom_user;
        this.image = image;
        this.nbr_jaime = nbr_jaime;
    }

    public Post_forum(int id, String sujet, String description, String communaute, String nom_user, Date date_p, String image, int nbr_jaime) {
        this.id = id;
        this.sujet = sujet;
        this.description = description;
        this.communaute = communaute;
        this.nom_user = nom_user;
        this.date_p = date_p;
        this.image = image;
        this.nbr_jaime = nbr_jaime;
    }

    public Post_forum(String sujet, String description, String communaute, String nom_user, String image) {
        this.sujet = sujet;
        this.description = description;
        this.communaute = communaute;
        this.nom_user = nom_user;
        this.image = image;
    }

    

   

    

    
    public int getIdPost() {
        return id;
    }

    public void setIdPost(int idPost) {
        this.id = idPost;
    }

    public String getSujet() {
        return sujet;
    }

    public void setSujet(String sujet) {
        this.sujet = sujet;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getCommunaute() {
        return communaute;
    }

    public void setCommunaute(String communaute) {
        this.communaute = communaute;
    }

    public String getNom_user() {
        return nom_user;
    }

    public void setNom_user(String nom_user) {
        this.nom_user = nom_user;
    }

    public Date getDate_p() {
        return date_p;
    }

    public void setDate_p(Date date_p) {
        this.date_p = date_p;
    }

    public int getNbr_jaime() {
        return nbr_jaime;
    }

    public void setNbr_jaime(int nbr_jaime) {
        this.nbr_jaime = nbr_jaime;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }
    

    @Override
    public String toString() {
        return "Post{" + "idPost=" + id + ", sujet=" + sujet + ", description=" + description + ", communaute=" + communaute + ", nom_user=" + nom_user + ", date_p=" + date_p + '}';
    }
    
    
}
