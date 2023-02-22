/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.gui;

import edu.troc.model.commentaire;
import edu.troc.model.poste;
import edu.troc.services.commentaireCRUD;
import edu.troc.services.posteCRUD;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;

/**
 * FXML Controller class
 *
 * @author Nguira Azyz
 */
public class Ajouter_commentaireController implements Initializable {

    private TextField fxcomm;
    @FXML
    private Button ajouter_com;
    @FXML
    private TextArea comm;
    
   @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    
    @FXML
    private void ajouter_com(ActionEvent event) {
        String com = comm.getText();
       
        System.out.println(comm.getText());
         commentaire c = new commentaire(com);
        commentaireCRUD commentaire = new commentaireCRUD();
        if (com.isEmpty())
        { 
            Alert alert = new Alert(Alert.AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("commentaire vide!");
        alert.show();
        }
        else{
        commentaire.ajoutercommentaire(c);
        Alert alert = new Alert(Alert.AlertType.INFORMATION);

        alert.setTitle("Information Dialog");
        alert.setHeaderText(null);
        alert.setContentText("commentaire insérée avec succés!");
        alert.show();
        
        }
    }}
