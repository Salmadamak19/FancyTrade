/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package GUI;

import Entity.Reclamation;
import Services.Reclamation_services;
import java.io.IOException;
import java.net.URL;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXMLLoader;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.stage.Stage;






/**
 * FXML Controller class
 *
 * @author fairouzkhayat
 */
public class InterfaceReclamationController implements Initializable {

    @FXML
    private Button btnliste;
    @Override
    public void initialize(URL url, ResourceBundle rb) 
    {}
     @FXML
     private void gotopage(ActionEvent event) throws IOException{
        FXMLLoader loader = new FXMLLoader(getClass().getResource("list_reclamation.fxml"));
    }
    @FXML
    private TextField idnum;
    @FXML
    private TextField iddate_reclamation;
     @FXML
    private TextArea idcontenu;
    @FXML
    private TextField idobjet;
    @FXML
    private ChoiceBox<?> idtype;
    @FXML
    private Button idajouter;

    @FXML
    private void ajouter(ActionEvent event) {
        
       Reclamation p = new Reclamation(idnum.getText(),iddate_reclamation.getText(),idcontenu.getText());
       Reclamation_services s= new Reclamation_services();
       s.ADD(p); 
    }
  }  
    

