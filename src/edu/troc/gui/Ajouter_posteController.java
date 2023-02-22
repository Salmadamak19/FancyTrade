/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.gui;

import edu.troc.model.poste;
import edu.troc.services.posteCRUD;
import java.net.URL;
import java.sql.Date;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.TextField;

/**
 * FXML Controller class
 *
 * @author Nguira Azyz
 */
public class Ajouter_posteController implements Initializable {

    @FXML
    private TextField fxdate_publication;
    @FXML
    private TextField fxphoto;
    @FXML
    private TextField fxregion;
    @FXML
    private TextField fxcategorie;
    @FXML
    private TextField fxdescription;
    @FXML
    private TextField fxvaleur;
    @FXML
    private TextField fxtitre;
    @FXML
    private Button ajouter_post;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void ajouter_post(ActionEvent event) {
        String date_publication = fxdate_publication.getText();
        String photo = fxphoto.getText();
        String region = fxregion.getText();
        String categorie = fxcategorie.getText();
         String description = fxdescription.getText();
        int valeur = Integer.parseInt(fxvaleur.getText());
         String titre = fxtitre.getText();
        
         poste p = new poste(date_publication, photo, region, categorie, description, valeur, titre);
        posteCRUD post = new posteCRUD();
        if (region.isEmpty())
        { 
            Alert alert = new Alert(AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("region vide!");
        alert.show();
        }else if ( titre.isEmpty())
        { 
            Alert alert = new Alert(AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("titre vide!");
        alert.show();
        }else if(description.isEmpty())
        { 
            Alert alert = new Alert(AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("description vide!");
        alert.show();
        }else if(categorie.isEmpty())
        { 
            Alert alert = new Alert(AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("categorie vide!");
        alert.show();
        }else if(valeur<0){
            Alert alert = new Alert(AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("valeur negatif!");
        alert.show();
        }
        else{
        post.ajouterposte(p);
        Alert alert = new Alert(AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("poste insérée avec succés!");
        alert.show();
        
        }

    
    }
    
}
