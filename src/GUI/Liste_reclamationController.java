/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Entity.Reclamation;
import Entity.Reclamation_Category;
import Services.Reclamation_category_services;
import Services.Reclamation_services;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ComboBox;
import javafx.scene.control.ListView;

/**
 * FXML Controller class
 *
 * @author fairouzkhayat
 */
public class Liste_reclamationController implements Initializable {

    @FXML
    private ListView<Reclamation> _reclamations_;
    @FXML
    private ComboBox<Reclamation_Category> _category_;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        //System.out.println("msg"+new Reclamation_category_services().READALL().values());
       _category_.getItems().setAll(new Reclamation_category_services().READALL().values());
    }    
    private void afficher(){
        _reclamations_.getItems().setAll(new Reclamation_services().READALL(_category_.getSelectionModel().getSelectedItem()).values());
    }
    @FXML
    private void modifier(ActionEvent event) {
    }

    @FXML
    private void supprimer(ActionEvent event) {
    }

    @FXML
    private void init(ActionEvent event) {
        afficher();
    }
    
}
