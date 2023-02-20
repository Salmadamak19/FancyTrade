package Services;

import DB.Database;
import Entities.Conversation;
import com.mysql.cj.xdevapi.Statement;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
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

            connection = Database.getInstance().getCon();
            //       Statement stmt = connection.getCon().createStatement();
            String query = "SELECT id,idconv_user,idconv_user2 FROM conv WHERE idconv_user = ? OR idconv_user2 = ?";
            PreparedStatement statement;
            statement = connection.prepareStatement(query);
            statement.setString(1, id);
            statement.setString(2, id);

            ResultSet rs = statement.executeQuery();

            while (rs.next()) {
                // String id_receiver = testt.GetReceiver(id, rs.getString("id"));
                Conversation conv = new Conversation(rs.getInt("id"), rs.getInt("idconv_user"), rs.getInt("idconv_user2"));
                /*   Label label = new Label();
                label.setUserData(conv);
                label.setText(conv.toString());
                //label.setAlignment(Pos.CENTER);
                label.setFont(new Font(20));
                label.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
                label.setPadding(new Insets(20, 25, 20, 25));*/
                HBox conversationContainer = new HBox();
                conversationContainer.setPadding(new Insets(20, 25, 20, 25));
                conversationContainer.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
                Text clientConversations = new Text(conv.toString());
                clientConversations.setUserData(conv);
                clientConversations.setFill(Color.WHITE); // set the text color to white
                clientConversations.setFont(Font.font("Verdana", FontWeight.BOLD, 20));
                conversationContainer.getChildren().add(clientConversations);
                listView.getChildren().add(conversationContainer);
                // listView.setStyle("-fx-text-fill: transparent; -fx-background-color: transparent;");

            }

            // connection.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return listView;
    }

}
