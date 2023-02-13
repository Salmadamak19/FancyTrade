
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.scene.control.TextArea;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
/**
 *
 * @author oussema
 */
public class sql_things {

    String prenom(String id) {
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
            Logger.getLogger(Chat_Server.ClientHandler.class.getName()).log(Level.SEVERE, null, ex);
        }
        return user_id;
    }

    void retrieveMessagesFromDB(String receiverID, String clientID, TextArea messages) {
        Connection connection;
        connection = Database.getInstance().getCon();
        try {
            PreparedStatement preparedStatement = connection.prepareStatement("SELECT * FROM message where from_user = ? OR from_user = ? AND to_user = ? OR to_user = ? ORDER BY date_time");
            preparedStatement.setString(1, receiverID);
            preparedStatement.setString(2, clientID);
            preparedStatement.setString(3, receiverID);
            preparedStatement.setString(4, clientID);
            ResultSet resultSet = preparedStatement.executeQuery();

            while (resultSet.next()) {
                String from = resultSet.getString("from_user");
                String to = resultSet.getString("to_user");
                String message = resultSet.getString("message_text");
                if (clientID.equals(from)) {
                    messages.appendText("You : " + message + "\n");

                } else {
                    messages.appendText(prenom(from) +  " : " + message + "\n");
                }
                // messages.appendText(prenom(from) + " To " + prenom(to) + " : " + message + "\n");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

}
