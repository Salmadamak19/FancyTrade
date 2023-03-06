/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.gui;

import edu.troc.interfaces.IcommentaireCRUD;
import edu.troc.model.commentaire;
import edu.troc.services.commentaireCRUD;
import java.net.URL;
import java.util.List;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.ListView;

/**
 * FXML Controller class
 *
 * @author Nguira Azyz
 */
public class Afficher_commentaireController implements Initializable {

    @FXML
    private ListView<commentaire> afficher_com;
    @FXML
    private Button supprimer_com;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        ListView<commentaire> list1 = afficher_com;
        IcommentaireCRUD inter = new commentaireCRUD();
        List<commentaire> list2 = inter.affichercommentaire();
        for (int i = 0; i < list2.size(); i++) {
            commentaire c = list2.get(i);
            list1.getItems().add(c);

    } 
    }    
    @FXML
    private void supprimer_commentaire(ActionEvent event) {
             
         ListView<commentaire> list = afficher_com;
         
        IcommentaireCRUD inter = new commentaireCRUD();
        int selectedIndex = list.getSelectionModel().getSelectedIndex();
        if (selectedIndex >= 0) {
            commentaire c = list.getSelectionModel().getSelectedItem();
            System.out.println(c.getId_com());
            inter.supprimercommentaire(c.getId_com());
            list.getItems().remove(selectedIndex);
        } else {
            System.out.println("Veuillez sélectionner un commentaire à supprimer.");
        }
    }
 } 

