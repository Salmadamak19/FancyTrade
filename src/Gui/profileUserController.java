/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Gui;

import java.net.URL;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;
import java.util.ResourceBundle;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Alert;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

/**
 *
 * @author user
 */
public class profileUserController implements Initializable{
    
    @FXML
    public ComboBox<?> ageUs;

    @FXML
    private Button btnModif;

    @FXML
    public Label codVUs;

    @FXML
    public TextField emailUs;

    @FXML
    public TextField motPasseUs;

    @FXML
    public TextField nomUs;

    @FXML
    public TextField prenomUs;
    

    @FXML
    public Label roleUs;

    private Connection connect;
    private PreparedStatement prepare;
    private ResultSet result;
    private Alert alert;
    private final int ageList[] ={22,23,24,25,26,27,28};
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        userAgeList();
      
    }
    
    
    public void userAgeList(){
        List<Integer> aList = new ArrayList<>();
        for(Integer data: ageList ){
            aList.add(data);
        }
        
        ObservableList listData = FXCollections.observableArrayList(aList);
        ageUs.setItems(listData);
    }
    
}
