
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/javafx/FXMLController.java to edit this template
 */
import Services.ServiceConversation;
import Services.ServiceMessage;
import Entities.Conversation;
import Entities.Message;
import Server.ServerMessage;
import java.io.ByteArrayInputStream;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
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
import javafx.scene.control.ButtonType;
import javafx.scene.control.ContextMenu;
import javafx.scene.control.Dialog;
import javafx.scene.control.Label;
import javafx.scene.control.MenuItem;
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

    private int id;
    @FXML
    private Button send_button;
    @FXML
    private TextField message_input;
    private DataInputStream dis;
    private DataOutputStream dos;
    private ObjectInputStream in;
    private ObjectOutputStream out;

    private String clientID = "2";
    ServiceMessage testt = new ServiceMessage();
    ServiceConversation convv = new ServiceConversation();
    Conversation Current_conv = new Conversation();
    @FXML
    private VBox inbox_list;
    @FXML
    private VBox message_box;
    @FXML
    private Label alertlabel;

    /**
     * Initializes the controller class.
     */
    @Override
    public void initialize(URL url, ResourceBundle rb) {
        inbox_list.setPadding(new Insets(10));
        inbox_list.setSpacing(10);
        alertlabel.setVisible(false);
        convv.GetConversations(clientID, inbox_list);
        try {
            Socket socket = new Socket("localhost", 9999);
            dis = new DataInputStream(socket.getInputStream());
            dos = new DataOutputStream(socket.getOutputStream());
            dos.writeUTF(clientID);
            System.out.println("clientid sent to server");
        } catch (IOException ex) {
            Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
        }
        Thread thread = new Thread(() -> {
            while (true) {
                try {
                    String readutf = dis.readUTF();

                    if (readutf != null) {
                        Platform.runLater(() -> {
                            String[] receivedData = readutf.split(";;");
                            String type = receivedData[0];
                            String senderID = receivedData[1];
                            String receiverID = receivedData[2];
                            String text = receivedData[3];
                            if (type.equals("0")) {
                                Message messagee = testt.messagefromserver(readutf, Current_conv);
                                System.out.println("hello");
                                if (messagee != null) {
                                    HBox messageContainer = new HBox();
                                    messageContainer.setId(Integer.toString(messagee.getId_message()));
                                    Text senderMessage = new Text(testt.prenom(Integer.toString(messagee.getFrom_user())) + " : " + messagee.getText());
                                    senderMessage.setFill(Color.WHITE);
                                    senderMessage.setFont(Font.font("Verdana", FontWeight.BOLD, 15));
                                    messageContainer.setPadding(new Insets(0, 0, 0, 10));
                                    messageContainer.setStyle("-fx-background-color: #808080; -fx-background-radius: 0px;");
                                    messageContainer.getChildren().add(senderMessage);
                                    message_box.getChildren().add(messageContainer);
                                }
                            } else if (type.equals("1")) {
                                for (Node child : message_box.getChildren()) {
                                    if (child.getId() != null && child.getId().equals(text)) {
                                        message_box.getChildren().remove(child);
                                        break;
                                    }
                                }
                            } else if (type.equals("2")) {
                                String[] contenu = text.split("--");
                                String idhbox = contenu[0];
                                String modifiedtext = contenu[1];
                                for (Node child : message_box.getChildren()) {
                                    if (child.getId() != null && child.getId().equals(idhbox)) {
                                        HBox hbox1 = (HBox) child;
                                        Text text1 = (Text) hbox1.getChildren().get(0);
                                        text1.setText(modifiedtext + " (modifié)");
                                        break;
                                    }
                                }

                            }

                        });
                    }
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        });
        thread.setDaemon(true);
        thread.start();
    }

    @FXML
    private void Send_message(ActionEvent event) throws IOException {
        if (!testt.checkInput(message_input, alertlabel)) {
            try {
                dos.writeUTF("0" + ";;" + clientID + ";;" + Current_conv.getId() + ";;" + message_input.getText());
                Message m = new Message(Integer.parseInt(clientID), Current_conv, message_input.getText());
                testt.sendmessage(m, message_box);
                message_input.clear();
                alertlabel.setVisible(false);
            } catch (IOException ex) {
                Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
            }
        }

    }

    @FXML
    private void switch_conversation(MouseEvent event) {
        alertlabel.setVisible(false);
        int index = 0;
        Node target = (Node) event.getTarget();
        if (target instanceof Text) {
            while (index < inbox_list.getChildren().size()) {
                Node node = inbox_list.getChildren().get(index);
                node.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
                index++;
            }
            HBox clickedHbox = (HBox) target.getParent();
            clickedHbox.setStyle("-fx-background-color: #007bff; -fx-background-radius: 50px;");

            Text text = (Text) target;
            Current_conv = (Conversation) text.getUserData();
            testt.retrieveMessagesFromDB(clientID, message_box, Current_conv);
        } else if (target instanceof HBox) {
            while (index < inbox_list.getChildren().size()) {
                Node node = inbox_list.getChildren().get(index);
                node.setStyle("-fx-background-color: #808080; -fx-background-radius: 50px;");
                index++;
            }
            HBox clickedHbox = (HBox) target;
            clickedHbox.setStyle("-fx-background-color: #007bff; -fx-background-radius: 50px;");
            Conversation conv;
            Text text = new Text();
            for (Node child : ((HBox) target).getChildren()) {
                if (child instanceof Text) {
                    text = (Text) child;
                }
            }
            conv = (Conversation) text.getUserData();
            Current_conv = (Conversation) text.getUserData();
            testt.retrieveMessagesFromDB(clientID, message_box, Current_conv);

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
                MenuItem option3 = new MenuItem("Modifier");
                option1.setOnAction(e -> {
                    testt.deletemessage(target.getId());
                    message_box.getChildren().remove(target);
                    try {
                        dos.writeUTF("1" + ";;" + clientID + ";;" + Current_conv.getId() + ";;" + target.getId());
                    } catch (IOException ex) {
                        Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });
                option2.setOnAction(e -> {
                    message_box.getChildren().remove(target);
                });
                option3.setOnAction(e -> {
                    Dialog<String> dialog = new Dialog<>();
                    dialog.setTitle("Input Dialog");
                    dialog.setHeaderText("Enter a text");
                    Label label = new Label("Text:");
                    TextField textField = new TextField();
                    VBox content = new VBox(label, textField);
                    dialog.getDialogPane().setContent(content);
                    dialog.getDialogPane().getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);
                    //  message_box.getChildren().remove(target);
                    dialog.setResultConverter(button -> {
                        if (button == ButtonType.OK) {
                            return textField.getText();
                        }
                        return null;
                    });
                    dialog.showAndWait();
                    if (!dialog.getResult().trim().isEmpty() && dialog.getResult() != null) {
                        testt.updatemessage(target.getId(), dialog.getResult());
                        HBox hbox = (HBox) target;
                        Text text = (Text) hbox.getChildren().get(0);
                        text.setText(dialog.getResult() + " (modifié)");
                        try {
                            dos.writeUTF("2" + ";;" + clientID + ";;" + Current_conv.getId() + ";;" + target.getId() + "--" + dialog.getResult());
                        } catch (IOException ex) {
                            Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
                        }
                        System.out.println("text : " + dialog.getResult());
                    }
                    // target.getChildren().get(0).setText(dialog.getResult);
                });
                if (!testt.messageowner(target.getId()).equals(clientID)) {
                    if (contextMenu.isShowing()) {
                        contextMenu.hide();
                    }
                    contextMenu.getItems().add(option2);
                    contextMenu.show(target, Side.BOTTOM, 0, 0);
                } else {
                    if (contextMenu.isShowing()) {
                        contextMenu.hide();
                    }
                    contextMenu.getItems().addAll(option1, option2, option3);
                    contextMenu.show(target, Side.BOTTOM, 0, 0);
                }

            }

        } else if (target instanceof Text) {
            Node targett = target.getParent();
            if (event.getButton() == MouseButton.SECONDARY) {
                ContextMenu contextMenu = new ContextMenu();
                MenuItem option1 = new MenuItem("Supprimer pour tout le monde");
                MenuItem option2 = new MenuItem("Supprimer");
                MenuItem option3 = new MenuItem("Modifier");
                option1.setOnAction(e -> {
                    testt.deletemessage(targett.getId());
                    message_box.getChildren().remove(targett);
                    try {
                        dos.writeUTF("1" + ";;" + clientID + ";;" + Current_conv.getId() + ";;" + targett.getId());
                    } catch (IOException ex) {
                        Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
                    }
                });
                option2.setOnAction(e -> {
                    message_box.getChildren().remove(targett);
                });
                option3.setOnAction(e -> {
                    Dialog<String> dialog = new Dialog<>();
                    dialog.setTitle("Input Dialog");
                    dialog.setHeaderText("Enter a text");

                    // Create a label and a text field
                    Label label = new Label("Text:");
                    TextField textField = new TextField();
                    VBox content = new VBox(label, textField);
                    dialog.getDialogPane().setContent(content);
                    dialog.getDialogPane().getButtonTypes().addAll(ButtonType.OK, ButtonType.CANCEL);
                    //  message_box.getChildren().remove(target);
                    dialog.setResultConverter(button -> {
                        if (button == ButtonType.OK) {
                            return textField.getText();
                        }
                        return null;
                    });
                    dialog.showAndWait();
                    if (!dialog.getResult().trim().isEmpty() && dialog.getResult() != null) {
                        testt.updatemessage(targett.getId(), dialog.getResult());
                        Text text = (Text) target;
                        text.setText(dialog.getResult() + " (modifié)");
                        try {
                            dos.writeUTF("2" + ";;" + clientID + ";;" + Current_conv.getId() + ";;" + targett.getId() + "--" + dialog.getResult());
                        } catch (IOException ex) {
                            Logger.getLogger(ChatInboxController.class.getName()).log(Level.SEVERE, null, ex);
                        }
                    }
                    // target.getChildren().get(0).setText(dialog.getResult);
                });
                if (!testt.messageowner(targett.getId()).equals(clientID)) {
                    if (contextMenu.isShowing()) {
                        contextMenu.hide();
                    }
                    contextMenu.getItems().add(option2);
                    contextMenu.show(target, Side.BOTTOM, 0, 0);
                } else {
                    if (contextMenu.isShowing()) {
                        contextMenu.hide();
                    }
                    contextMenu.getItems().addAll(option1, option2, option3);
                    contextMenu.show(target, Side.BOTTOM, 0, 0);

                }

            }
        }

    }
}
