/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Entity;

import Functions.sql_things;





/**
 *
 * @author oussema
 */
public class Conversation {

    int id;
    int idconv_user;
    int idconv_user2;

    public Conversation() {
    }

    public Conversation(int id, int idconv_user, int idconv_user2) {
        this.id = id;
        this.idconv_user = idconv_user;
        this.idconv_user2 = idconv_user2;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getIdconv_user() {
        return idconv_user;
    }

    public void setIdconv_user(int idconv_user) {
        this.idconv_user = idconv_user;
    }

    public int getIdconv_user2() {
        return idconv_user2;
    }

    public void setIdconv_user2(int idconv_user2) {
        this.idconv_user2 = idconv_user2;
    }

    @Override
    public String toString() {
       // return "Conversation{" + "id=" + id + ", idconv_user=" + idconv_user + ", idconv_user2=" + idconv_user2 + '}';
               String Client_id = "1";
        sql_things testt = new sql_things();
       String Receiver = testt.GetReceiver(Client_id,Integer.toString(id));
        return testt.prenom(Receiver);
    }


}
