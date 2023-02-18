/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Entity;

import org.eclipse.persistence.jpa.jpql.parser.DateTime;

/**
 *
 * @author oussema
 */
public class Message {
    int id_message;
    int from_user;
    int to_conv;
    String text;
    DateTime date_time;

    public Message() {
    }

    public Message(int id_message, int from_user, int to_conv, String text) {
        this.id_message = id_message;
        this.from_user = from_user;
        this.to_conv = to_conv;
        this.text = text;
    }

    public Message(int id_message, int from_user, int to_conv, String text, DateTime date_time) {
        this.id_message = id_message;
        this.from_user = from_user;
        this.to_conv = to_conv;
        this.text = text;
        this.date_time = date_time;
    }

    public int getId_message() {
        return id_message;
    }

    public void setId_message(int id_message) {
        this.id_message = id_message;
    }

    public int getFrom_user() {
        return from_user;
    }

    public void setFrom_user(int from_user) {
        this.from_user = from_user;
    }

    public int getTo_conv() {
        return to_conv;
    }

    public void setTo_conv(int to_conv) {
        this.to_conv = to_conv;
    }

    public String getText() {
        return text;
    }

    public void setText(String text) {
        this.text = text;
    }

    public DateTime getDate_time() {
        return date_time;
    }

    public void setDate_time(DateTime date_time) {
        this.date_time = date_time;
    }

    @Override
    public String toString() {
        return "Message{" + "id_message=" + id_message + ", from_user=" + from_user + ", to_conv=" + to_conv + ", text=" + text + ", date_time=" + date_time + '}';
    }
    
}