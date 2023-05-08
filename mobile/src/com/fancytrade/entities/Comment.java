package com.fancytrade.entities;

import com.fancytrade.utils.DateUtils;
import com.fancytrade.utils.Statics;

import java.util.Date;

public class Comment implements Comparable<Comment> {

    private int id;
    private Publication publication;
    private User user;
    private String content;
    private Date date;

    public Comment() {
    }

    public Comment(int id, Publication publication, User user, String content, Date date) {
        this.id = id;
        this.publication = publication;
        this.user = user;
        this.content = content;
        this.date = date;
    }

    public Comment(Publication publication, User user, String content, Date date) {
        this.publication = publication;
        this.user = user;
        this.content = content;
        this.date = date;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Publication getPublication() {
        return publication;
    }

    public void setPublication(Publication publication) {
        this.publication = publication;
    }

    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }

    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    @Override
    public int compareTo(Comment comment) {
        switch (Statics.compareVar) {
            case "Publication":
                return this.getPublication().getContent().compareTo(comment.getPublication().getContent());
            case "User":
                return this.getUser().getEmail().compareTo(comment.getUser().getEmail());
            case "Content":
                return this.getContent().compareTo(comment.getContent());
            case "Date":
                DateUtils.compareDates(this.getDate(), comment.getDate());

            default:
                return 0;
        }
    }

}