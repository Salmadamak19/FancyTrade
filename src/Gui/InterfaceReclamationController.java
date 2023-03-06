/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXMLController.java to edit this template
 */
package GUI;

import Entities.Reclamation;
import Services.ServiceReclamation;
import java.io.IOException;
import java.net.URL;
import java.time.LocalDate;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ChoiceBox;
import javafx.scene.control.DatePicker;
import javafx.scene.control.TextField;
import javafx.stage.Stage;
import javax.swing.JOptionPane;

/**
 * FXML Controller class
 *
 * @author fairouz
 */
public class InterfaceReclamationController implements Initializable {

    @FXML
    private TextField idobjet;
    @FXML
    private Button btnlist;
    @FXML
    private Button idajouter;
    @FXML
    private TextField idcontenu;
    @FXML
    private DatePicker date;
    @FXML
    private TextField type;
    @FXML
    private TextField categorie;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void gotopage(ActionEvent event) throws IOException {
            FXMLLoader loader = new FXMLLoader(getClass().getResource("listeReclamation.fxml"));
        Parent root = loader.load();
        Scene newScene = new Scene(root);
        Stage stage = (Stage) btnlist.getScene().getWindow();
        stage.setScene(newScene);
        stage.show();
    }

    @FXML
    private void ajouter(ActionEvent event) {
          ServiceReclamation srch = new ServiceReclamation();
               
            
LocalDate daterec = date.getValue();
int cat = Integer.parseInt(categorie.getText());
 String typ = type.getText();
  String contenu = idcontenu.getText();
   String obj = idobjet.getText();  
    
     Reclamation res = new Reclamation( daterec ,cat, typ, contenu, obj);
                      ServiceReclamation service = new ServiceReclamation();

    service.ajouter(res);
          JOptionPane.showMessageDialog(null, "Reclamation envoyé avec success !");
          service.afficher();
    }
    }
    

