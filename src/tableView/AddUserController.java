/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXMLController.java to edit this template
 */
package tableView;

import helpers.DbConnect;
import java.lang.System.Logger;
import java.lang.System.Logger.Level;
import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ResourceBundle;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseEvent;
import javafx.scene.text.Text;
import models.User;


/**
 * FXML Controller class
 *
 * @author user
 */
public class AddUserController implements Initializable {

    @FXML
    private Text nameFid;
    @FXML
    private Text birthFid;
    @FXML
    private Text adressFid;
    @FXML
    private Text emailFid;
    

    User user = null;
    private boolean update;
            int userId;
    @FXML
    private TextField nameeFid;
    @FXML
    private TextField birthhFid;
    @FXML
    private TextField adresssFid;
    @FXML
    private TextField emaillFid;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
    }    

    @FXML
    private void save(MouseEvent event) {
        
     
        String name = nameeFid.getText();
        String birth = birthhFid.getText();
        String adress = adresssFid.getText();
        String email = emaillFid.getText();
        
        if(name.isEmpty()||birth.isEmpty()||adress.isEmpty()||email.isEmpty()){
            Alert alert = new Alert(Alert.AlertType.ERROR);
            alert.setHeaderText(null);
            alert.setContentText("Please FIll All DATA");
            alert.showAndWait();
            
        }else{
                        Connection connection;
            connection = DbConnect.getInstance().getCon();
        try{
            PreparedStatement statement;
            String query = "INSERT INTO user(name,birth,adress,email) VALUES(?,?,?,?)";
            
        statement = connection.prepareStatement(query);
        statement.setString(1, nameeFid.getText());
        statement.setString(2, birthhFid.getText());
        statement.setString(3, adresssFid.getText());
        statement.setString(4, emaillFid.getText());
        statement.executeQuery();
        
    } catch (SQLException ex) {
        java.util.logging.Logger.getLogger(TableViewController.class.getName()).log(java.util.logging.Level.SEVERE, null, ex);
    }
        }
    }

    @FXML
    private void clean () {
        nameeFid.setText(null);
        birthhFid.setText(null);
        adresssFid.setText(null);
        emaillFid.setText(null);
    }


}
