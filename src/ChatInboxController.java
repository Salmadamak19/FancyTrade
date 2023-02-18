

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
import javafx.application.Platform;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.geometry.Insets;
import javafx.geometry.Side;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.ContextMenu;
import javafx.scene.control.Label;
import javafx.scene.control.ListView;
import javafx.scene.control.MenuItem;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseButton;
import javafx.scene.input.MouseEvent;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;
import javafx.scene.text.Text;

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
    private int convid;
    sql_things testt = new sql_things();
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

    public void run() {
        while (true) {
            try {
                String message = dis.readUTF();
                String[] receivedData = message.split(";;");
                System.out.println("hello");
                String senderID = receivedData[0];
                String receiverID = receivedData[1];
                String text = receivedData[2];
                if (convid == Integer.parseInt(receiverID)) {
                    HBox messageContainer = new HBox();
                    // messageContainer.setId(senderID);
                    Text senderMessage = new Text(testt.prenom(senderID) + " : " + text);
                    senderMessage.setFill(Color.WHITE); // set the text color to white
                    senderMessage.setFont(Font.font("Verdana", FontWeight.BOLD, 15)); // set the font
                    // senderMessage.setStyle("-fx-background-color: #808080; -fx-background-radius: 0px;");
                    messageContainer.setStyle("-fx-background-color: #808080; -fx-background-radius: 0px;");
                    // senderMessage.setStyle("-fx-background-color: #FFFFFF; -fx-padding: 10px;");
                    messageContainer.getChildren().add(senderMessage);
                    message_box.getChildren().add(messageContainer);
                }
            } catch (IOException e) {
                System.out.println("Server disconnected");
                break;
            }
        }
    }

    @FXML
    private void Send_message(ActionEvent event) {
        try {
            dos.writeUTF(clientID + ";;" + convid + ";;" + message_input.getText());
            String conv = Integer.toString(convid);
            testt.sendmessage(message_input.getText(), clientID, conv, message_box);
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
            convid = id_conv;

            // Do something with the clicked label
            // System.out.println("Clicked on label: " + conv.getId())
            testt.retrieveMessagesFromDB(clientID, message_box, id_conv);
        }
    }

    @FXML
    private void message_option(MouseEvent event) {
        Node target = (Node) event.getTarget();
        if (target instanceof HBox) {

            if (event.getButton() == MouseButton.SECONDARY) {
                ContextMenu contextMenu = new ContextMenu();
                MenuItem option1 = new MenuItem("Supprimer pour tout le monde");
                MenuItem option2 = new MenuItem("Supprimer");
                option1.setOnAction(e -> {
                    testt.deletemessage(target.getId());
                    message_box.getChildren().remove(target);
                });
                                option2.setOnAction(e -> {
                    message_box.getChildren().remove(target);
                });
                contextMenu.getItems().addAll(option1,option2);
                contextMenu.show(target, Side.BOTTOM, 0, 0);
              
            }

        }

    }
}
