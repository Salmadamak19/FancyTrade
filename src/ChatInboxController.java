

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXMLController.java to edit this template
 */
import Functions.Conversations;
import Functions.sql_things;
import Entity.Conversation;
import Entity.Message;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.net.Socket;
import java.net.URL;
import java.util.ResourceBundle;
import java.util.logging.Level;
import java.util.logging.Logger;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.VBox;

/**
 * FXML Controller class
 *
 * @author oussema
 */
public class ChatInboxController implements Initializable {

    @FXML
    private Button send_button;
    @FXML
    private TextField message_input;
    private DataInputStream dis;
    private DataOutputStream dos;
    private String clientID = "1";
    private String convid;
    sql_things testt = new sql_things();
    int Current_conv_id;
    Conversations convv = new Conversations();
    Conversation Current_conv = new Conversation();
    @FXML
    private VBox inbox_list;
    @FXML
    private VBox message_box;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        inbox_list.setPadding(new Insets(10));
        inbox_list.setSpacing(10);
        // inbox_list.setStyle("-fx-background-color: #f2f2f2;");

        // inbox_list.setAlignment(Pos.TOP_CENTER);
        convv.GetConversations(clientID, inbox_list);
        // inbox_list.getChildren().

        // convid = inbox_list.getSelectionModel().getSelectedItem();
        try {
            Socket socket = new Socket("localhost", 9999);
            dis = new DataInputStream(socket.getInputStream());
            dos = new DataOutputStream(socket.getOutputStream());
            dos.writeUTF(clientID);
        } catch (IOException ex) {
            Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    @FXML
    private void Send_message(ActionEvent event) {
        try {
            Current_conv = inbox_list.getSelectionModel().getSelectedItem();
            Current_conv_id = Current_conv.getId();
            dos.writeUTF(clientID + ";;" + Current_conv_id + ";;" + message_input.getText());
            testt.sendmessage(message_input.getText(), message_box);
            //   messages_box.appendText("You: " + message_input.getText() + "\n");
            message_input.clear();
        } catch (IOException ex) {
            Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
        }

    }

    @FXML
    private void switch_conversation(MouseEvent event) {
        int index = 0;
        Node target = (Node) event.getTarget();
        if (target instanceof Label) {
            // Cast the target node to a Label
            while (index < inbox_list.getChildren().size()) {
    Node node = inbox_list.getChildren().get(index);
    node.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
    index++;
}
            Label clickedLabel = (Label) target;
            clickedLabel.setStyle("-fx-background-color: #007bff; -fx-background-radius: 50px;");
            Conversation conv;
            conv = (Conversation) clickedLabel.getUserData();
            int id_conv = conv.getId();

            // Do something with the clicked label
            // System.out.println("Clicked on label: " + conv.getId())
            testt.retrieveMessagesFromDB(clientID, message_box, id_conv);
        }
    }

}
