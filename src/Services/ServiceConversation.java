package Services;

import DB.Database;
import Entities.Conversation;
import com.mysql.cj.xdevapi.Statement;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.geometry.Insets;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.Text;

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
/**
 *
 * @author oussema
 */
public class ServiceConversation {

    Connection connection;
    Statement ste;
    ServiceMessage testt = new ServiceMessage();

    public ServiceConversation() {

        connection = Database.getInstance().getCon();
    }

    public VBox GetConversations(String id, VBox listView) {
        try {
            listView.getChildren().clear();

            connection = Database.getInstance().getCon();
            String query = "SELECT id,idconv_user,idconv_user2 FROM conv WHERE idconv_user = ? OR idconv_user2 = ?";
            PreparedStatement statement;
            statement = connection.prepareStatement(query);
            statement.setString(1, id);
            statement.setString(2, id);

            ResultSet rs = statement.executeQuery();

            while (rs.next()) {
                Conversation conv = new Conversation(rs.getInt("id"), rs.getInt("idconv_user"), rs.getInt("idconv_user2"));
                HBox conversationContainer = new HBox();
                conversationContainer.setPadding(new Insets(20, 25, 20, 25));
                conversationContainer.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
                Text clientConversations = new Text(conv.showidreceiver(id));
                clientConversations.setUserData(conv);
                clientConversations.setFill(Color.WHITE);
                clientConversations.setFont(Font.font("Verdana", FontWeight.BOLD, 20));
                conversationContainer.getChildren().add(clientConversations);
                listView.getChildren().add(conversationContainer);

            }

            // connection.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return listView;
    }

    public VBox SearchConversations(String Name, String id, VBox listView) {
        try {
            listView.getChildren().clear();
            System.out.println("step 1");
            connection = Database.getInstance().getCon();
            String query = "SELECT * FROM conv c \n"
                    + "WHERE (c.idconv_user = ? OR c.idconv_user2 = ?) \n"
                    + "AND EXISTS (SELECT * FROM user u WHERE (c.idconv_user = u.id_user AND u.prenom LIKE CONCAT('%', ?, '%')) OR (c.idconv_user2 = u.id_user AND u.prenom LIKE CONCAT('%', ?, '%')))";
            PreparedStatement statement;
            statement = connection.prepareStatement(query);
            statement.setString(1, id);
            statement.setString(2, id);
            statement.setString(4, Name);
            statement.setString(3, Name);
            ResultSet rs = statement.executeQuery();
            System.out.println("step 1.2");
            while (rs.next()) {
                System.out.println("step 2");
                Conversation conv = new Conversation(rs.getInt("c.id"), rs.getInt("c.idconv_user"), rs.getInt("c.idconv_user2"));
                HBox conversationContainer = new HBox();
                conversationContainer.setPadding(new Insets(20, 25, 20, 25));
                conversationContainer.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
                Text clientConversations = new Text(conv.showidreceiver(id));
                System.out.println(conv.showidreceiver(id));
                clientConversations.setUserData(conv);
                clientConversations.setFill(Color.WHITE);
                clientConversations.setFont(Font.font("Verdana", FontWeight.BOLD, 20));
                conversationContainer.getChildren().add(clientConversations);
                listView.getChildren().add(conversationContainer);

            }
        } catch (SQLException ex) {
            Logger.getLogger(ServiceConversation.class.getName()).log(Level.SEVERE, null, ex);
        }
        return listView;

    }
}
