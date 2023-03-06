/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.services;

import edu.troc.interfaces.IcommentaireCRUD;
import edu.troc.model.commentaire;
import edu.troc.model.poste;
import edu.troc.utils.MyConnection;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;



/**
 *
 * @author Nguira Azyz
 */
public class commentaireCRUD implements IcommentaireCRUD{
    Statement ste;
    Connection conn = MyConnection.getInstance().getConn();
    
    @Override
    public void ajoutercommentaire(commentaire c) {
        try {
            String req = "INSERT INTO `comments_poste`(`com`) VALUES ('"+c.getCom()+"')";
            ste = conn.createStatement();
            ste.executeUpdate(req);
            System.out.println("commentaire ajouté!!!");
        } catch (SQLException ex) {
            System.out.println("commentaire non ajouté");
                      }
 }
    
    public List<commentaire> affichercommentaire() {
       List<commentaire> list = new ArrayList<>();
        try {
            String req = "Select * from comments_poste";
            Statement st = conn.createStatement();
           
            ResultSet RS= st.executeQuery(req);
            while(RS.next()){
             commentaire c = new commentaire();
             c.setId_com(RS.getInt(1));
                c.setCom(RS.getString(2));
               
                        
                
             
             list.add(c);
            }
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }

        return list;
    }
        @Override
    public void supprimercommentaire(int id) {
        try {
            String req = "DELETE FROM `comments_poste` WHERE id_com = " + id;
            Statement st = conn.createStatement();
            st.executeUpdate(req);
            System.out.println("commentaire deleted !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }
        @Override
    public void modifiercommentaire(commentaire c ) {
        try {
            String req = "UPDATE `comments_poste` SET `com` = '" + c.getCom()+ "' WHERE `id_com` = " + c.getId_com();
            Statement st = conn.createStatement();
            st.executeUpdate(req);
            System.out.println("commentaire updated !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        }
}
