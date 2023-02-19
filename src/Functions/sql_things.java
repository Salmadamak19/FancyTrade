package Functions;

import DB.Database;
import Entity.Message;
import com.mysql.cj.xdevapi.Statement;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.geometry.BoundingBox;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.scene.control.Label;
import javafx.scene.control.TextArea;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.Text;
import javafx.scene.text.TextAlignment;
import javafx.scene.text.TextBoundsType;
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

    public String GetReceiver(String id, String convid) {
        Connection connection;
        connection = Database.getInstance().getCon();
        String query = "SELECT idconv_user FROM conv WHERE idconv_user2 = ? AND id = ?";
        PreparedStatement statement;
        String user_id = null;
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
        if (user_id == null) {
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
        } else {
            System.out.println(" not nullllllll");
        }
        return user_id;
    }

    public void retrieveMessagesFromDB(String clientID, VBox messages, int id_conv) {
        messages.getChildren().clear();
        Connection connection;
        connection = Database.getInstance().getCon();
        //listView.getItems().get(0)
        //  messagess.setSpacing(10);
        try {
            PreparedStatement preparedStatement = connection.prepareStatement("SELECT * FROM message where to_conv = ? ORDER BY date_time");
            preparedStatement.setString(1, Integer.toString(id_conv));
            ResultSet resultSet = preparedStatement.executeQuery();

            while (resultSet.next()) {
                String id = resultSet.getString("id_message");
                String from = resultSet.getString("from_user");
                String message = resultSet.getString("message_text");
                
                HBox messageContainer = new HBox();
                messageContainer.setId(id);
                if (clientID.equals(from)) {
                    //messages.setTextAlignment(TextAlignment.RIGHT);
                    Text clientMessage = new Text(message);
                    clientMessage.setFill(Color.WHITE); // set the text color to white
                    clientMessage.setFont(Font.font("Verdana", FontWeight.BOLD, 15));
                    //clientMessage.setWrappingWidth(100);
                    //  clientMessage.setStyle("-fx-background-color: #2196F3; -fx-padding: 10px;");
                    //  double textWidth = clientMessage.getBoundsInLocal().getWidth();

                    messageContainer.setAlignment(Pos.CENTER_RIGHT);
                    messageContainer.setStyle("-fx-background-color: #007bff; -fx-background-radius: 0px;");
                    // messageContainer.setPrefWidth(1);
                    messageContainer.setPadding(new Insets(0, 20, 0, 0));
                    messageContainer.getChildren().add(clientMessage);

                } else {
                    Text senderMessage = new Text(prenom(from) + " : " + message);
                    senderMessage.setFill(Color.WHITE); // set the text color to white
                    senderMessage.setFont(Font.font("Verdana", FontWeight.BOLD, 15)); // set the font
                    // senderMessage.setStyle("-fx-background-color: #808080; -fx-background-radius: 0px;");
                    messageContainer.setPadding(new Insets(0, 0, 0, 10));
                    messageContainer.setStyle("-fx-background-color: #808080; -fx-background-radius: 0px;");
                    // senderMessage.setStyle("-fx-background-color: #FFFFFF; -fx-padding: 10px;");
                    messageContainer.getChildren().add(senderMessage);

                }

                messages.getChildren().add(messageContainer);
                //    messages.getChildren().add(messageBox);
                // messages.appendText(prenom(from) + " To " + prenom(to) + " : " + message + "\n");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void sendmessage(String message, String clientid, String conv, VBox messages) {
        Connection connection;
        connection = Database.getInstance().getCon();
        String query2 = "INSERT INTO message(from_user,to_conv,message_text) VALUES(?,?,?)";
        PreparedStatement statement2;
        int id_message = -1;
        try {
            statement2 = connection.prepareStatement(query2, PreparedStatement.RETURN_GENERATED_KEYS);
            statement2.setString(1, clientid);

            statement2.setString(2, conv);
            statement2.setString(3, message);
            int affectedRows = statement2.executeUpdate();

            if (affectedRows == 0) {
                throw new SQLException("Creating record failed, no rows affected.");
            }
            try ( ResultSet rs = statement2.getGeneratedKeys()) {
                if (rs.next()) {
                    id_message = rs.getInt(1);
                    // Use the last inserted ID here
                } else {
                    throw new SQLException("Creating record failed, no ID obtained.");
                }
            }

        } catch (SQLException ex) {
            Logger.getLogger(sql_things.class.getName()).log(Level.SEVERE, null, ex);
        }

        HBox messageContainer = new HBox();
       // StackPane stackPane = new StackPane();
        messageContainer.setId(Integer.toString(id_message));
        Text clientMessage = new Text(message);
        clientMessage.setFill(Color.WHITE); // set the text color to white
        clientMessage.setFont(Font.font("Verdana", FontWeight.BOLD, 15));
       // clientMessage.setBoundsType(TextBoundsType.VISUAL);

      //  clientMessage.setPickOnBounds(false);;
        messageContainer.setPadding(new Insets(0, 20, 0, 0));
        //clientMessage.setWrappingWidth(100);
        //  clientMessage.setStyle("-fx-background-color: #2196F3; -fx-padding: 10px;");
        //  double textWidth = clientMessage.getBoundsInLocal().getWidth();

        messageContainer.setAlignment(Pos.CENTER_RIGHT);
        messageContainer.setStyle("-fx-background-color: #007bff; -fx-background-radius: 0px;");
        // messageContainer.setPrefWidth(1);
        // messageContainer.setPadding(new Insets(1, -50, 1, -5));
        messageContainer.getChildren().add(clientMessage);
        messages.getChildren().add(messageContainer);
        // messages.appendText(prenom(from) + " To " + prenom(to) + " : " + message + "\n");
    }

    public void deletemessage(String id) {
        Connection connection;
        connection = Database.getInstance().getCon();
        String query2 = "DELETE FROM message WHERE id_message = ?";
        PreparedStatement statement2;
        try {
            statement2 = connection.prepareStatement(query2);
            statement2.setString(1, id);
            statement2.executeUpdate();
        } catch (SQLException ex) {
            Logger.getLogger(sql_things.class.getName()).log(Level.SEVERE, null, ex);
        }

    }
        public void updatemessage(String id,String message) {
        Connection connection;
        connection = Database.getInstance().getCon();
        String query2 = "UPDATE message SET message_text = ? WHERE id_message = ?";
        PreparedStatement statement2;
        try {
            statement2 = connection.prepareStatement(query2);
            statement2.setString(2, id);
            statement2.setString(1, message+" (modifié)");
            statement2.executeUpdate();
        } catch (SQLException ex) {
            Logger.getLogger(sql_things.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

}
