/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;
import DB.Database;
import entities.User;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.Statement;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author azyz
 */
public class ServiceUser {

    Connection connection;
    Statement ste;

    public ServiceUser() {
        connection = Database.getInstance().getCon();
    }

    public ArrayList<User> afficher() {
        ArrayList<User> listusers = new ArrayList<>();
        try {
            ste = connection.createStatement();
            String req_select = "SELECT * FROM utilisateur";
            ResultSet res = ste.executeQuery(req_select);
            while (res.next()) {
                int id = res.getInt(1);
                String nom = res.getString(2);
                String prenom = res.getString(3);
                String mail = res.getString(4);
                String password = res.getString(6);
                String role = res.getString(7);

                User ur = new User(id, nom, prenom, mail, password, role);
                listusers.add(ur);
            }
        } catch (SQLException ex) {
            System.out.println("SQLException " + ex.getMessage());
        }

        return listusers;
    }

    public void SupprimerUser(int id) {

        try {
            System.out.println("supprimé");
            PreparedStatement pre = connection.prepareStatement("DELETE FROM user WHERE id_user = ?");
            pre.setInt(1, id);
            pre.executeUpdate();

        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
        }
    }

    public void ajouter2(User u) {
        try {
            PreparedStatement pre = connection.prepareStatement("INSERT INTO utilisateur (nom,prenom,mot_du_passe,email,type) VALUES (?,?,?,?,?)");

           
            pre.setString(1, u.getNom());
            pre.setString(2, u.getPrenom());
            pre.setString(3, u.getMdp());
            pre.setString(4, u.getEmail());
            pre.setString(5, u.getRole());

            pre.executeUpdate();
        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
        }

    }
      public void ajouter3(User u) {
        try {
            PreparedStatement pre = connection.prepareStatement("INSERT INTO user (email,mot_du_passe) VALUES (?,?)");

           
            pre.setString(1, u.getEmail());
            pre.setString(2, u.getMdp());
      

            pre.executeUpdate();
        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
        }

    }

    public User ChercherParMail(String mail) {

        try {
            PreparedStatement pre = connection.prepareStatement("SELECT * FROM utilisateur where email = ?");
            pre.setString(1, mail);
            ResultSet result = pre.executeQuery();
            while (result.next()) {
                User u = new User(result.getInt(1), result.getString(2), result.getString(3), result.getString(4), result.getString(6), result.getString(7));
                return u;
            }
        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
        }
        return null;
    }

    public void ModifierUser(User u) {

        try {

            PreparedStatement pre = connection.prepareStatement("UPDATE user SET nom=?,prenom=?,email=?,mot_du_passe=?,type=? WHERE id_user = ?");

           pre.setString(1, u.getNom());
            pre.setString(2, u.getPrenom());
            pre.setString(3, u.getEmail());
            pre.setString(4, u.getMdp());
            pre.setString(5, u.getRole());
            pre.setInt(6, u.getId());

            pre.executeUpdate();
        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
        }

    }

    public boolean isExiste(String mail) {

        try {
            PreparedStatement pre = connection.prepareStatement("SELECT * FROM utilisateur where email = ?");
            pre.setString(1, mail);
            ResultSet result = pre.executeQuery();
            return result.first();
        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
            return false;
        }
    }
    
    
    
    public User ChercherParId(int id) {

        try {
            PreparedStatement pre = connection.prepareStatement("SELECT * FROM utilisateur where id = ?");
            pre.setInt(1, id);
            ResultSet result = pre.executeQuery();
            while (result.next()) {
                User u = new User(result.getInt(1), result.getString(2), result.getString(3), result.getString(4), result.getString(6), result.getString(7));
                return u;
            }
        } catch (SQLException ex) {
            System.out.print(ex.getMessage());
        }
        return null;
    }
    
    
     public int CountUsersPerRole(String Role) {

        int i = 0;
        String requete = "SELECT * FROM user where type= ?  ";

        try {
            PreparedStatement pst = connection.prepareStatement(requete);
            pst.setString(1,Role);
            ResultSet rs = pst.executeQuery();
            while (rs.next()) {
             i=i+1;
            }
          
         return i; 
         

        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
        return i;
    }

   
}