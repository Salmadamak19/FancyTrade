package com.fancytrade.entities;

import com.fancytrade.utils.DateUtils;
import com.fancytrade.utils.Statics;

import java.util.Date;

public class Commentaire implements Comparable<Commentaire> {

    private int id;
    private User user;
    private Post post;
    private String image;
    private String description;
    private Date date;
    private String analyse;
    private Date datecTs;

    public Commentaire() {
    }

    public Commentaire(int id, User user, Post post, String image, String description, Date date, String analyse, Date datecTs) {
        this.id = id;
        this.user = user;
        this.post = post;
        this.image = image;
        this.description = description;
        this.date = date;
        this.analyse = analyse;
        this.datecTs = datecTs;
    }

    public Commentaire(User user, Post post, String image, String description, Date date, String analyse, Date datecTs) {
        this.user = user;
        this.post = post;
        this.image = image;
        this.description = description;
        this.date = date;
        this.analyse = analyse;
        this.datecTs = datecTs;
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

    public Post getPost() {
        return post;
    }

    public void setPost(Post post) {
        this.post = post;
    }

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public String getAnalyse() {
        return analyse;
    }

    public void setAnalyse(String analyse) {
        this.analyse = analyse;
    }

    public Date getDatecTs() {
        return datecTs;
    }

    public void setDatecTs(Date datecTs) {
        this.datecTs = datecTs;
    }


    @Override
    public int compareTo(Commentaire commentaire) {
        switch (Statics.compareVar) {
            case "User":
                return this.getUser().getEmail().compareTo(commentaire.getUser().getEmail());
            case "Post":
                return this.getPost().getSujet().compareTo(commentaire.getPost().getSujet());
            case "Image":
                return this.getImage().compareTo(commentaire.getImage());
            case "Description":
                return this.getDescription().compareTo(commentaire.getDescription());
            case "Date":
                DateUtils.compareDates(this.getDate(), commentaire.getDate());
            case "Analyse":
                return this.getAnalyse().compareTo(commentaire.getAnalyse());
            case "DatecTs":
                DateUtils.compareDates(this.getDatecTs(), commentaire.getDatecTs());

            default:
                return 0;
        }
    }

}