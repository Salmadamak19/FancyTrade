
package gestion_echange;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;

public class user extends  Application {
    @Override
    public void start(Stage stage) throws Exception {
        Parent root = FXMLLoader.load(getClass().getResource("echange2.fxml"));
        Scene scene = new Scene (root);
        stage.setScene(scene);
        stage.show(); 
    }
    
     public static void main(String[] args) {
         launch(args);
    }
    
}
