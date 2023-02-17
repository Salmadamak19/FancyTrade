package Functions;


import DB.Database;
import Entity.Conversation;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.layout.HBox;
import javafx.scene.text.Font;
import javafx.scene.text.Text;
import javafx.scene.text.TextAlignment;
import javafx.scene.text.TextFlow;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
/**
 *
 * @author oussema
 */
public class sql_things {

   public String prenom(String id) {
        Connection connection;
        connection = Database.getInstance().getCon();
        String query = "SELECT prenom FROM user WHERE id_user = ?";
        PreparedStatement statement;
        String user_id = "not set";
        try {
            statement = connection.prepareStatement(query);
            statement.setString(1, id);

            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                user_id = resultSet.getString(1); //"zadaz";
            }

        } catch (SQLException ex) {
           
        }
        return user_id;
    }
       public String GetReceiver(String id,String convid) {
        Connection connection;
        connection = Database.getInstance().getCon();
        String query = "SELECT idconv_user FROM conv WHERE idconv_user2 = ? AND id = ?";
        PreparedStatement statement;
        String user_id= null;
        try {
            statement = connection.prepareStatement(query);
            statement.setString(1, id);
            statement.setString(2, convid);

            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                user_id = resultSet.getString(1); //"zadaz";
            }

        } catch (SQLException ex) {
           
        }
        if(user_id == null){
            System.out.println("nullllllll");
         query = "SELECT idconv_user2 FROM conv WHERE idconv_user = ? AND id = ?";
        try {
            statement = connection.prepareStatement(query);
            statement.setString(1, id);
            statement.setString(2, convid);

            ResultSet resultSet = statement.executeQuery();

            while (resultSet.next()) {
                user_id = resultSet.getString(1); //"zadaz";
            }

        } catch (SQLException ex) {
        
        }
        }else{
        System.out.println(" not nullllllll");
        }
        return user_id;
    }


   public void retrieveMessagesFromDB(String clientID, TextFlow messages, ListView<Conversation> listView) {
                messages.getChildren().clear();

        Connection connection;
        connection = Database.getInstance().getCon();
        Conversation Current_conv = listView.getSelectionModel().getSelectedItem();
        int Current_conv_id = Current_conv.getId();
        //listView.getItems().get(0)
        //  messagess.setSpacing(10);
        try {
            PreparedStatement preparedStatement = connection.prepareStatement("SELECT * FROM message where to_conv = ? ORDER BY date_time");
            preparedStatement.setString(1, Integer.toString(Current_conv_id));
            ResultSet resultSet = preparedStatement.executeQuery();

            while (resultSet.next()) {
                String from = resultSet.getString("from_user");
                String message = resultSet.getString("message_text");
                Text messageText = new Text(message + "");
                messageText.setFont(Font.font("Arial", 14));

                Label userLabel = new Label(from);
                userLabel.setFont(Font.font("Arial", 12));

                HBox messageBox = new HBox();
                messageBox.getChildren().add(userLabel);
                messageBox.getChildren().add(messageText);
                messageBox.setSpacing(10);
                if (clientID.equals(from)) {
                    //messages.setTextAlignment(TextAlignment.RIGHT);
                    // messages.appendText("You : " + message + "\n");
                    messageBox.setStyle("-fx-background-color: blue; -fx-padding: 5px;");
                    messageBox.setAlignment(javafx.geometry.Pos.TOP_RIGHT);
                    messageText.setFill(javafx.scene.paint.Color.WHITE);
                    messageText.setTextAlignment(TextAlignment.RIGHT);

                } else {
                    //  messages.appendText(prenom(from) + " : " + message + "\n");
                    messageBox.setStyle("-fx-background-color: lightgray; -fx-padding: 5px;");
                    messageBox.setAlignment(javafx.geometry.Pos.TOP_LEFT);
                    messageText.setFill(javafx.scene.paint.Color.BLACK);
                    messageText.setTextAlignment(TextAlignment.LEFT);
                }
                messages.getChildren().add(messageBox);
                // messages.appendText(prenom(from) + " To " + prenom(to) + " : " + message + "\n");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }
   public void sendmessage(String message,TextFlow messages){
        Text messageText = new Text(message + "");
        messageText.setFont(Font.font("Arial", 14));
        HBox messageBox = new HBox();
        messageBox.getChildren().add(messageText);
        messageBox.setSpacing(10);
        //messages.setTextAlignment(TextAlignment.RIGHT);
        // messages.appendText("You : " + message + "\n");
        messageBox.setStyle("-fx-background-color: blue; -fx-padding: 5px;");
        messageBox.setAlignment(javafx.geometry.Pos.TOP_RIGHT);
        messageText.setFill(javafx.scene.paint.Color.WHITE);
        messageText.setTextAlignment(TextAlignment.RIGHT);
        messages.getChildren().add(messageBox);
        // messages.appendText(prenom(from) + " To " + prenom(to) + " : " + message + "\n");
    }

}
