
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

class ClientHandler implements Runnable {

    private Socket client;
    private DataInputStream dis;
    private DataOutputStream dos;

    ClientHandler(Socket client) throws IOException {
        this.client = client;
        this.dis = new DataInputStream(client.getInputStream());
        this.dos = new DataOutputStream(client.getOutputStream());
    }

    @Override
    public void run() {
        while (true) {
            try {
                String message = dis.readUTF();
                System.out.println("Message from client: " + message);
                String[] receivedData = message.split(";;");
                Connection connection;
                connection = Database.getInstance().getCon();
                String query = "SELECT prenom FROM user WHERE id_user = ?";
                String query2 = "INSERT INTO message(from_user,to_user,message_text) VALUES(?,?,?)";
                PreparedStatement statement2;
                PreparedStatement statement;
                try {
                    statement = connection.prepareStatement(query);
                    statement2 = connection.prepareStatement(query2);
                    statement.setString(1, receivedData[0]);
                    statement2.setString(1, receivedData[0]);
                    statement2.setString(2, receivedData[1]);
                    statement2.setString(3, receivedData[2]);
                    statement2.executeUpdate();

                    ResultSet resultSet = statement.executeQuery();
                    String user_id = "not set";
                    while (resultSet.next()) {
                        user_id = resultSet.getString(1); //"zadaz";
                    }

                    String receiver_id = receivedData[1];
                    String messageee = receivedData[2];
                    dos.writeUTF(user_id + ";;" + receiver_id + ";;" + messageee);
                } catch (SQLException ex) {
                    Logger.getLogger(ClientHandler.class.getName()).log(Level.SEVERE, null, ex);
                }

            } catch (IOException e) {
                System.out.println("Client disconnected");
                break;
            }
        }
    }
}

public class Chat_Server {

    public static void main(String[] args) throws IOException {
        ServerSocket server = new ServerSocket(9999);
        System.out.println("Server started. Waiting for clients...");

        while (true) {
            Socket client = server.accept();
            System.out.println("Client connected: " + client.getInetAddress().getHostAddress());

            ClientHandler clientHandler = new ClientHandler(client);
            Thread thread = new Thread(clientHandler);
            thread.start();
        }
    }
}
