
import Functions.sql_things;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.net.Socket;
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
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import static javafx.application.Application.launch;
import javafx.scene.text.Font;

class ReceiverThread implements Runnable {

    private DataInputStream dis;
    private TextArea messages;
sql_things testt = new sql_things();
    ReceiverThread(DataInputStream dis, TextArea messages) {
        this.dis = dis;
        this.messages = messages;
    }
}

public class User_Chat extends Application {
    private DataInputStream dis;
    private DataOutputStream dos;
    private TextArea messages = new TextArea();
    private TextField input = new TextField();
    private Button send = new Button("Send");
    private String clientID = "1";
    private String receiverID = "2";
    sql_things testt = new sql_things();

    @Override
    public void start(Stage Stage) {
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

        Scene scene = new Scene(root, 400, 400);
        Stage.setScene(scene);
        Stage.show();
    }
    public static void main(String[] args) {
        launch(args);
    }
}
