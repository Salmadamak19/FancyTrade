/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXML2.java to edit this template
 */
package crud_app.controllers;
import crud_app.utils.database;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Connection;
import java.net.URL;
import java.sql.SQLException;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.fxml.Initializable;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.Alert;
import javafx.scene.control.Alert.AlertType;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.PasswordField;
import javafx.scene.control.TextField;
import javafx.scene.layout.BorderPane;
import javafx.stage.Stage;


/**
 *
 * @author user
 */
public class FXMLDocumentController implements Initializable {
    public Label codVUs;
    public ComboBox<?> ageUs;
    public TextField emailUs;

    public TextField motPasseUs;

    public TextField nomUs;

    public TextField prenomUs;

    public Label roleUs;

    @FXML
    private TextField ageFld;

    @FXML
    private Button btnCnx;
    
    @FXML
    private Button btnConnexion;
    
    @FXML
    private Button btnCreateCompte;

    @FXML
    private BorderPane inscrpForm;

    @FXML
    private TextField loginFld;

    @FXML
    private BorderPane loginForm;

    @FXML
    private TextField mailFld;

    @FXML
    private PasswordField mpFld;

    @FXML
    private TextField nomFld;

    @FXML
    private TextField prenFld;

    @FXML
    private PasswordField passwordFld;

    
    private Connection connect;
    private PreparedStatement prepare;
    private ResultSet result;
    private Alert alert;
    @FXML
    private Button btnInscription;
    
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        // TODO
      
    }
    @FXML    
    public void loginAccount(){
            String sql="SELECT * FROM utilisateur WHERE email = ? and mdp = ?";
            connect = database.connect();
        try{
            Alert alert;
            if(loginFld.getText().isEmpty() || mpFld.getText().isEmpty() ){
                alert=new Alert(AlertType.ERROR);
                alert.setTitle("Message d'erreurs");
                alert.setHeaderText(null);
                alert.setContentText("Veuillez saisir votre login et mot de passe");
                alert.showAndWait();
            } else{
                prepare = connect.prepareStatement(sql);
                prepare.setString(1, loginFld.getText());
                prepare.setString(2, mpFld.getText());
                result=prepare.executeQuery();
                // a ajouter pour passer 2 controllers
                if(result.next()){
                     alert=new Alert(AlertType.INFORMATION);
                     alert.setTitle("Message d'information");
                     alert.setHeaderText(null);
                     alert.setContentText("Vous ete connecté avec succès");
                     alert.showAndWait();
                     // pour disparaitre le loginForm
                     btnConnexion.getScene().getWindow().hide();
                    if(result.getInt("role")==1)
                    {
                       // pour afficher le CRUD ADMIN
                     Parent root = FXMLLoader.load(getClass().getResource("/crud_app/fxml/CRUDUser.fxml"));
                     Stage stage = new Stage();
                     Scene scene = new Scene(root);
                     stage.setScene(scene);
                     stage.show(); 
                    }else if(result.getInt("role")==2){
                      
                       
                        Parent root = FXMLLoader.load(getClass().getResource("/crud_app/fxml/profileUser.fxml"));
                        Stage stage = new Stage();
                        Scene scene = new Scene(root);
                        stage.setScene(scene);
                        stage.show(); 
                        
                    }
 
                }else{
                    // si login et mot de passe invalides
                     alert=new Alert(AlertType.ERROR);
                     alert.setTitle("Message d'erreurs");
                     alert.setHeaderText(null);
                     alert.setContentText("Login et/ou mot de passe invalide");
                     alert.showAndWait();
                }
            }
            
        }catch(Exception e){
            e.printStackTrace();
        }
        
    }
    
    public void displayData(){
     
        try {
            String sql="SELECT * FROM utilisateur WHERE email = ?";
            connect = database.connect();
            prepare = connect.prepareStatement(sql);
            prepare.setString(1, loginFld.getText());
            result=prepare.executeQuery();
            
            if(result.next()){
                
                nomUs.setText(result.getString("nom"));
                prenomUs.setText(result.getString("nom"));
                emailUs.setText(result.getString("email"));
                //ageUs.setText(result.getString("age"));
                motPasseUs.setText(result.getString("mdp"));
                roleUs.setText(result.getString("role"));
                codVUs.setText(result.getString("verification_code"));
            }
            
        } catch (SQLException ex) {
            Logger.getLogger(FXMLDocumentController.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }
    @FXML
    public void registerAccount(){
        String sql="INSERT INTO utilisateur(nom, prenom, email, age, mdp, role, verification_code) VALUES (?,?,?,?,?,?,?)";
        connect = database.connect();
        try{
            Alert alert;
            if(nomFld.getText().isEmpty()||prenFld.getText().isEmpty()||mailFld.getText().isEmpty()||ageFld.getText().isEmpty()||passwordFld.getText().isEmpty())
            {
                alert=new Alert(AlertType.ERROR);
                alert.setTitle("Message d'erreurs");
                alert.setHeaderText(null);
                alert.setContentText("Veuillez remplir les champs obligatoires");
                alert.showAndWait();
                
            }else{
                String checkData="SELECT email from utilisateur where email ='"+mailFld.getText()+"'";
                prepare=connect.prepareCall(checkData);
                result=prepare.executeQuery();
                if(result.next()){
                    alert=new Alert(AlertType.ERROR);
                    alert.setTitle("Message d'erreurs");
                    alert.setHeaderText(null);
                    alert.setContentText(mailFld.getText()+" Email existe déjà !! ");
                    alert.showAndWait();
            }else{
                    if(passwordFld.getText().length() < 8 ){
                alert=new Alert(AlertType.ERROR);
                alert.setTitle("Message d'erreurs");
                alert.setHeaderText(null);
                alert.setContentText("Mot de passe invalide");
                alert.showAndWait();
            }else{ 
                prepare=connect.prepareCall(sql);
                prepare.setString(1, nomFld.getText());
                prepare.setString(2, prenFld.getText());
                prepare.setString(3, mailFld.getText());
                prepare.setInt(4, Integer.parseInt(ageFld.getText()));
                prepare.setString(5, passwordFld.getText());
                prepare.setInt(6,2);
                prepare.setInt(7,200);
                prepare.executeUpdate();
                alert=new Alert(AlertType.INFORMATION);
                alert.setTitle("Message d'information");
                alert.setHeaderText(null);
                alert.setContentText("Inscription effectuée avec succès");
                alert.showAndWait();
                loginForm.setVisible(true);
                inscrpForm.setVisible(false);
                loginFld.setText("");
                mpFld.setText("");    
            }
            }
            }
            
            }catch(Exception e){
            e.printStackTrace();
        }
        
    }
    @FXML
     public void switchForm(ActionEvent event){
         if(event.getSource()==this.btnCreateCompte){
             loginForm.setVisible(false);
             inscrpForm.setVisible(true);
         }else if(event.getSource()==this.btnCnx){
             loginForm.setVisible(true);
             inscrpForm.setVisible(false);
         }
                
         }
}
