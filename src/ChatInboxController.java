

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXMLController.java to edit this template
 */


import Functions.Conversations;
import Functions.sql_things;
import Entity.Conversation;
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
import javafx.scene.control.Button;
import javafx.scene.control.ListView;
import javafx.scene.control.TextField;
import javafx.scene.input.MouseEvent;
import javafx.scene.text.TextFlow;

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
    Conversations convv= new Conversations();
    Conversation Current_conv = new Conversation();
    @FXML
    private ListView<Conversation> inbox_list;
    @FXML
    private TextFlow message_box;
    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
                         convv.GetConversations(clientID,inbox_list);
                    
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
        testt.retrieveMessagesFromDB(clientID,message_box,inbox_list);
    }
    
}
