/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Entity;

import java.sql.Timestamp;
import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.layout.StackPane;
import javafx.stage.Stage;

/**
 *
 * @author fairouzkhayat
 */

   public class Reclamation {
    private int id;
    private String reclamation_Date;
    private String reclamation_category_id;
    private String user_id;
    private String reclamation_type;
    private String description;
    private String object;

    public Reclamation() {
    }

     
        public Reclamation(String reclamation_category_id, String reclamation_type, String description) {
        this.reclamation_category_id = reclamation_category_id;
        this.reclamation_type = reclamation_type;
        this.description = description;
    }

    public Reclamation(String reclamation_category_id, String reclamation_Date, String reclamation_type, String description) {
        this.reclamation_Date = reclamation_Date;
        this.reclamation_type = reclamation_type;
        this.reclamation_category_id = reclamation_category_id;
        this.description = description;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getReclamation_category_id() {
        return reclamation_category_id;
    }

    public void setReclamation_category_id(String reclamation_category_id) {
        this.reclamation_category_id = reclamation_category_id;
    }

    public String getUser_id() {
        return user_id;
    }

    public void setUser_id(String user_id) {
        this.user_id = user_id;
    }

    public String getReclamation_type() {
        return reclamation_type;
    }

    public void setReclamation_type(String reclamation_type) {
        this.reclamation_type = reclamation_type;
    }



    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }



    public String getReclamation_Date() {
        return reclamation_Date;
    }

    /**
     * @param reclamation_Date the reclamation_Date to set
     */
    public void setReclamation_Date(String reclamation_Date) {
        this.reclamation_Date = reclamation_Date;
    }

    /**
     * @return the object
     */
    public String getObject() {
        return object;
    }

    /**
     * @param object the object to set
     */
    public void setObject(String object) {
        this.object = object;
    }
}

    

