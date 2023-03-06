
import com.twilio.twiml.voice.Sms;
import edu.services.SmS;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author salma
 */
public class BLOG1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        String Txt="hii Salma";
        SmS s =new SmS();
        s.send_sms("+21652532874", Txt);
        
        
        
    }
    
}
