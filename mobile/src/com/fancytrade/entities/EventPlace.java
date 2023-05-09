package com.fancytrade.entities;

public class EventPlace implements Comparable<EventPlace> {
    private int id;
    private String name;
    private String description;

    public EventPlace() {
    }

    public EventPlace(int id, String name, String description) {
        this.id = id;
        this.name = name;
        this.description = description;
    }

    public EventPlace(String name, String description) {
        this.name = name;
        this.description = description;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
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

    @Override
    public String toString() {
        return "EventPlace{" +
                "id=" + id +
                ", name='" + name + '\'' +
                ", description='" + description + '\'' +
                '}';
    }

    @Override
    public int compareTo(EventPlace eventPlace) {
        // Implement the comparison logic based on your requirements
        // Return a negative integer if this event place is less than the other
        // Return a positive integer if this event place is greater than the other
        // Return 0 if this event place is equal to the other
        // Modify the comparison logic according to your needs
        return this.getName().compareTo(eventPlace.getName());
    }
}
