/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Entity;

import com.fancytrade.entities.EventPlace;
import com.fancytrade.entities.User;
import com.fancytrade.utils.DateUtils;
import com.fancytrade.utils.Statics;
import java.util.Date;

public class Event {
    private Integer id;
    private String name;
    private String description;
    private EventPlace place;
    private String image;
    private Date dateAndTime;
    private User user;
    private String organiser;
    private byte[] imageFile;
    
    public Event() {
        // Empty constructor
    }

    public Event(Integer id, String name, String description, EventPlace place, String image, Date dateAndTime, User user, String organiser, byte[] imageFile) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.place = place;
        this.image = image;
        this.dateAndTime = dateAndTime;
        this.user = user;
        this.organiser = organiser;
        this.imageFile = imageFile;
    }

    public Event(String name, String description, EventPlace place, String image, Date dateAndTime, User user, String organiser, byte[] imageFile) {
        this.name = name;
        this.description = description;
        this.place = place;
        this.image = image;
        this.dateAndTime = dateAndTime;
        this.user = user;
        this.organiser = organiser;
        this.imageFile = imageFile;
    }

    public void setId(Integer id) {
        this.id = id;
    }
    
    
    public Integer getId() {
        return id;
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
    
    public EventPlace getPlace() {
        return place;
    }
    
    public void setPlace(EventPlace place) {
        this.place = place;
    }
    
    public String getImage() {
        return image;
    }
    
    public void setImage(String image) {
        this.image = image;
    }
    
    public Date getDateAndTime() {
        return dateAndTime;
    }
    
    public void setDateAndTime(Date dateAndTime) {
        this.dateAndTime = dateAndTime;
    }
    
    public User getUser() {
        return user;
    }
    
    public void setUser(User user) {
        this.user = user;
    }
    
    public String getOrganiser() {
        return organiser;
    }
    
    public void setOrganiser(String organiser) {
        this.organiser = organiser;
    }
    
    public void setImageFile(byte[] imageFile) {
        this.imageFile = imageFile;
    }
    
    public byte[] getImageFile() {
        return imageFile;
    }
    public int compareTo(Event event) {
    switch (Statics.compareVar) {
        case "Name":
            return this.getName().compareTo(event.getName());
        case "Description":
            return this.getDescription().compareTo(event.getDescription());
        case "Place":
            return this.getPlace().compareTo(event.getPlace());
        case "Image":
            return this.getImage().compareTo(event.getImage());
        case "DateAndTime":
            return DateUtils.compareDates(this.getDateAndTime(), event.getDateAndTime());
        case "User":
            return this.getUser().getEmail().compareTo(event.getUser().getEmail());
        case "Organizer":
            return this.getOrganiser().compareTo(event.getOrganiser());
        default:
            return 0;
    }
}


}