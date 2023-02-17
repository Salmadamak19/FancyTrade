
import Functions.sql_things;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.net.Socket;
import java.security.Timestamp;
import javafx.application.Application;
import javafx.application.Platform;
import javafx.geometry.Insets;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import static javafx.application.Application.launch;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import javafx.scene.control.ListView;
import javafx.scene.layout.BorderPane;
import javafx.scene.text.Font;

class ReceiverThread implements Runnable {

    private DataInputStream dis;
    private TextArea messages;

    ReceiverThread(DataInputStream dis, TextArea messages) {
        this.dis = dis;
        this.messages = messages;
    }
sql_things testt= new sql_things();;
    @Override
    public void run() {
        while (true) {
            try {
                String message = dis.readUTF();
                String[] receivedData = message.split(";;");

                String senderID = receivedData[0];
                String receiverID = receivedData[1];
                String text = receivedData[2];
                Platform.runLater(() -> messages.appendText(testt.prenom(senderID) + " To " + testt.prenom(receiverID) + " : " + text + "\n"));
            } catch (IOException e) {
                System.out.println("Server disconnected");
                break;
            }
        }
    }
}

public class User_Chat2 extends Application {
    private DataInputStream dis;
    private DataOutputStream dos;
    private TextArea messages = new TextArea();
    private TextField input = new TextField();
    private Button send = new Button("Send");
    private String clientID = "2";
    private String receiverID = "1";
    sql_things testt = new sql_things();
                FXMLLoader loader = new FXMLLoader(getClass().getResource("Chat Inbox.fxml"));
    GuiController controller = loader.getController();


    @Override
    public void start(Stage Stage) throws IOException {

    System.out.println("test");
   // controller.initialize(receiverID,clientID);
       // Parent root = loader.load();
       // Parent root = FXMLLoader.load(getClass().getResource("Chat Inbox.fxml"));
        VBox root = new VBox(10);
        root.setPadding(new Insets(10));

        messages.setPrefHeight(300);
        messages.setEditable(false);
        messages.setFont(Font.font("Arial", 15));

        HBox inputArea = new HBox(10);
        inputArea.getChildren().addAll(input, send);

        root.getChildren().addAll(messages, inputArea);

        send.setOnAction(event -> {
            try {
                dos.writeUTF(clientID + ";;" + receiverID + ";;" + input.getText());
                messages.appendText("You: " + input.getText() + "\n");
                input.clear();
            } catch (IOException e) {
                e.printStackTrace();
            }
        });

        try {
            
            testt.retrieveMessagesFromDB(receiverID,clientID,messages);
            Socket socket = new Socket("localhost", 9999);
            dis = new DataInputStream(socket.getInputStream());
            dos = new DataOutputStream(socket.getOutputStream());
            dos.writeUTF(clientID);
            ReceiverThread receiverThread = new ReceiverThread(dis, messages);
            Thread thread = new Thread(receiverThread);
            thread.start();
        } catch (IOException e) {
            e.printStackTrace();
        }

        Scene scene = new Scene(root);
        Stage.setScene(scene);
        Stage.show();
        
                

    }

    public static void main(String[] args) {
        launch(args);
    }
}
