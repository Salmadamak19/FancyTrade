package com.fancytrade.entities;

import com.fancytrade.utils.DateUtils;
import com.fancytrade.utils.Statics;

import java.util.Date;

public class Publication implements Comparable<Publication> {

    private int id;
    private User user;
    private String content;
    private Date date;
    private String image;

    public Publication() {
    }

    public Publication(int id, User user, String content, Date date, String image) {
        this.id = id;
        this.user = user;
        this.content = content;
        this.date = date;
        this.image = image;
    }

    public Publication(User user, String content, Date date, String image) {
        this.user = user;
        this.content = content;
        this.date = date;
        this.image = image;
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

    public String getImage() {
        return image;
    }

    public void setImage(String image) {
        this.image = image;
    }

    @Override
    public String toString() {
        return "Publication : " +
                "id=" + id
                + "\n User=" + user
                + "\n Content=" + content
                + "\n Date=" + date
                + "\n Image=" + image
                ;
    }

    @Override
    public int compareTo(Publication publication) {
        switch (Statics.compareVar) {
            case "User":
                return this.getUser().getEmail().compareTo(publication.getUser().getEmail());
            case "Content":
                return this.getContent().compareTo(publication.getContent());
            case "Date":
                DateUtils.compareDates(this.getDate(), publication.getDate());
            default:
                return 0;
        }
    }

}