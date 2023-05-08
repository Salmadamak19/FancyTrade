package com.fancytrade.entities;

import com.fancytrade.utils.DateUtils;
import com.fancytrade.utils.Statics;

import java.util.Date;

public class Post implements Comparable<Post> {

    private int id;
    private User user;
    private String sujet;
    private String description;
    private int nbrJaime;
    private String image;
    private Date date;
    private String communaute;
    private String analyse;
    private int liked;
    private int badlevel;

    public Post() {
    }

    public Post(int id, User user, String sujet, String description, int nbrJaime, String image, Date date, String communaute, String analyse, int liked, int badlevel) {
        this.id = id;
        this.user = user;
        this.sujet = sujet;
        this.description = description;
        this.nbrJaime = nbrJaime;
        this.image = image;
        this.date = date;
        this.communaute = communaute;
        this.analyse = analyse;
        this.liked = liked;
        this.badlevel = badlevel;
    }

    public Post(User user, String sujet, String description, int nbrJaime, String image, Date date, String communaute, String analyse, int liked, int badlevel) {
        this.user = user;
        this.sujet = sujet;
        this.description = description;
        this.nbrJaime = nbrJaime;
        this.image = image;
        this.date = date;
        this.communaute = communaute;
        this.analyse = analyse;
        this.liked = liked;
        this.badlevel = badlevel;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
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

    public int getNbrJaime() {
        return nbrJaime;
    }

    public void setNbrJaime(int nbrJaime) {
        this.nbrJaime = nbrJaime;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getCommunaute() {
        return communaute;
    }

    public void setCommunaute(String communaute) {
        this.communaute = communaute;
    }

    public String getAnalyse() {
        return analyse;
    }

    public void setAnalyse(String analyse) {
        this.analyse = analyse;
    }

    public int getLiked() {
        return liked;
    }

    public void setLiked(int liked) {
        this.liked = liked;
    }

    public int getBadlevel() {
        return badlevel;
    }

    public void setBadlevel(int badlevel) {
        this.badlevel = badlevel;
    }


    @Override
    public String toString() {
        return "Post : " +
                "id=" + id
                + "\\n User=" + user
                + "\\n Sujet=" + sujet
                + "\\n Description=" + description
                + "\\n NbrJaime=" + nbrJaime
                + "\\n Image=" + image
                + "\\n Date=" + date
                + "\\n Communaute=" + communaute
                + "\\n Analyse=" + analyse
                + "\\n Liked=" + liked
                + "\\n Badlevel=" + badlevel
                ;
    }

    @Override
    public int compareTo(Post post) {
        switch (Statics.compareVar) {
            case "User":
                return this.getUser().getEmail().compareTo(post.getUser().getEmail());
            case "Sujet":
                return this.getSujet().compareTo(post.getSujet());
            case "Description":
                return this.getDescription().compareTo(post.getDescription());
            case "NbrJaime":
                return Integer.compare(this.getNbrJaime(), post.getNbrJaime());
            case "Image":
                return this.getImage().compareTo(post.getImage());
            case "Date":
                DateUtils.compareDates(this.getDate(), post.getDate());
            case "Communaute":
                return this.getCommunaute().compareTo(post.getCommunaute());
            case "Analyse":
                return this.getAnalyse().compareTo(post.getAnalyse());
            case "Liked":
                return Integer.compare(this.getLiked(), post.getLiked());
            case "Badlevel":
                return Integer.compare(this.getBadlevel(), post.getBadlevel());

            default:
                return 0;
        }
    }

}