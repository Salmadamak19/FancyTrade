import Functions.sql_things;
import javafx.fxml.FXML;
import javafx.scene.control.TextArea;

public class GuiController {
    @FXML
    private TextArea textArea;
    sql_things testt = new sql_things();

    public void initialize(String receiverID, String clientID) {
        // initialize the text area with default text
       // textArea.setText("Hello, World!");
        testt.retrieveMessagesFromDB(receiverID,clientID,textArea);
    }

    public void settText(String text) {
        textArea.setText(text);
    }
}
