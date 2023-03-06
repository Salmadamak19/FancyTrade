/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package Services;

import DB.Database;
import Entities.ReclamationCategory;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author fairouz
 */
public class ServiceReclamationCategory implements IService<ReclamationCategory>{
      private Connection cnx = Database.getInstance().getCon();

    
    public void ajouter(ReclamationCategory rc) {
         try {
                    String req = "INSERT INTO reclamation_category(name,description_cat) VALUES(?,?)";
            
                    java.sql.PreparedStatement pst = cnx.prepareStatement(req);
             
       
        
      
        pst.setString(1, rc.getName());
         pst.setString(2, rc.getDescription());
         
      
        

            pst.executeUpdate();
            System.out.println("Reclamation category ajoutee !");
        } 
        catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
      
    }

  
    public void modifier(ReclamationCategory rc) {
        try {
        

        String requete = "UPDATE reclamation_category SET name=?,description_cat=? where category_id=?";
        PreparedStatement pst = cnx.prepareStatement(requete);

       

       
         
             
       
        
        
         pst.setString(1, rc.getName());
          pst.setString(2, rc.getDescription());
                  pst.setInt(3, rc.getId());


        pst.executeUpdate();

        System.out.println("reclamation categorie est modifiée !");
    } catch (SQLException ex) {
        System.err.println(ex.getMessage());
    } catch (IllegalArgumentException ex) {
        System.err.println(ex.getMessage());
    }
        
    }

    public void supprimer(ReclamationCategory rc) {
        String req = "DELETE FROM reclamation_category WHERE category_id="+rc.getId();
        try {
            Statement st = cnx.createStatement();
            st.executeUpdate(req);
            System.out.println("reclamation  categorie supprimee !");
        } catch (SQLException ex) {
            System.out.println(ex.getMessage());
        }
    }

    
    public List<ReclamationCategory> afficher() {
        List<ReclamationCategory> list = new ArrayList<>();
        
        
        try{
 String requete = "SELECT * FROM reclamation_category";
  PreparedStatement pst = cnx.prepareStatement(requete);
  ResultSet rs = pst.executeQuery();

  while (rs.next()) {


    int id = rs.getInt("category_id");
    String name = rs.getString("name");
    String description = rs.getString("description_cat");
    
    
   

    
   

    ReclamationCategory r = new ReclamationCategory(id,name,description);
    list.add(r);
      System.out.println(list);
  }}
catch(SQLException ex){
        System.err.println(ex.getMessage());
        }
return list ;

    }  
    
}
