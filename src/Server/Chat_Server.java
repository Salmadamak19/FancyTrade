package Server;

import DB.Database;
import Services.ServiceMessage;
import java.io.DataInputStream;
import java.io.DataOutputStream;
import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

public class Chat_Server {

    private static Map<String, Socket> clients = new HashMap<>();

    public static void main(String[] args) throws IOException {
        ServerSocket server = new ServerSocket(9999);
        System.out.println("Server started. Waiting for clients...");
        while (true) {
            Socket client = server.accept();
            DataInputStream dis = new DataInputStream(client.getInputStream());
            String clientID = dis.readUTF();
            clients.put(clientID, client);
            System.out.println("Client(" + clientID + ") connected: " + client.getInetAddress().getHostAddress());

            ClientHandler clientHandler = new ClientHandler(client, clientID);
            Thread thread = new Thread(clientHandler);
            thread.start();
        }
    }

    static class ClientHandler implements Runnable {

        private Socket client;
        private String clientID;
        private DataInputStream dis;
        private DataOutputStream dos;

        ClientHandler(Socket client, String clientID) throws IOException {
            this.client = client;
            this.clientID = clientID;
            this.dis = new DataInputStream(client.getInputStream());
            this.dos = new DataOutputStream(client.getOutputStream());
        }

        @Override
        public void run() {
            while (true) {
                try {
                    ServiceMessage testt = new ServiceMessage();
                    String message = dis.readUTF();
                    System.out.println("Message from client: " + message);
                    String[] receivedData = message.split(";;");
                    Connection connection;
                    connection = Database.getInstance().getCon();
                    String query = "SELECT prenom FROM user WHERE id_user = ?";
                    // String query2 = "INSERT INTO message(from_user,to_conv,message_text) VALUES(?,?,?)";
                    //  PreparedStatement statement2;
                    PreparedStatement statement;
                    try {
                        statement = connection.prepareStatement(query);
                        //   statement2 = connection.prepareStatement(query2);
                        statement.setString(1, receivedData[0]);
                        /*  statement2.setString(1, receivedData[0]);
                        statement2.setString(2, receivedData[1]);
                        statement2.setString(3, receivedData[2]);
                        statement2.executeUpdate();*/

                        ResultSet resultSet = statement.executeQuery();
                        String user_id = "not set";
                        while (resultSet.next()) {
                            user_id = resultSet.getString(1); //"zadaz";
                        };
                        String client_id = testt.GetReceiver(receivedData[0], receivedData[1]);
                        String messageee = receivedData[2];
                        //  dos.writeUTF(user_id + ";;" + receiver_id + ";;" + messageee);
                        // sendMessageToClient(receivedData[0], message);
                        sendMessageToClient(client_id, message);
                    } catch (SQLException ex) {
                        Logger.getLogger(ClientHandler.class.getName()).log(Level.SEVERE, null, ex);
                    }

                } catch (IOException e) {
                    System.out.println("Client disconnected");
                    break;
                }
            }
        }

        public void sendMessage(String message) {
            try {
                dos.writeUTF(message);
            } catch (IOException e) {
                System.out.println("Error sending message to " + clientID + ": " + e.getMessage());
                clients.remove(clientID);
            }
        }

        public void sendMessageToClient(String clientID, String message) {
            Socket socket = clients.get(clientID);
            if (socket != null) {
                try {
                    new ClientHandler(socket, clientID).sendMessage(message);
                    System.out.println("messenge sent to " + clientID);
                } catch (IOException ex) {
                    Logger.getLogger(Chat_Server.class.getName()).log(Level.SEVERE, null, ex);
                }
            } else {
                System.out.println("Error: no such client with id " + clientID);
            }
        }
    }
}
