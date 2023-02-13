
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

class ReceiverThread implements Runnable {

    private DataInputStream dis;
    private TextArea messages;

    ReceiverThread(DataInputStream dis, TextArea messages) {
        this.dis = dis;
        this.messages = messages;
    }
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
                        Logger.getLogger(Chat_Server.ClientHandler.class.getName()).log(Level.SEVERE, null, ex);
                    }
        return user_id;
        }
    @Override
    public void run() {
        while (true) {
            try {
                String message = dis.readUTF();
                String[] receivedData = message.split(";;");

                String senderID = receivedData[0];
                String receiverID = receivedData[1];
                String text = receivedData[2];
                Platform.runLater(() -> messages.appendText(prenom(senderID) + " To " + prenom(receiverID) + " : " + text + "\n"));
            } catch (IOException e) {
                System.out.println("Server disconnected");
                break;
            }
        }
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

    @Override
    public void start(Stage Stage) {
        VBox root = new VBox(10);
        root.setPadding(new Insets(10));

        messages.setPrefHeight(300);
        messages.setEditable(false);

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
