/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import DB.Database;
import Entities.Reclamation_Category;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.HashMap;
import java.util.UUID;


/**
 *
 * @author fairouzkhayat
 */
public class Reclamation_category_services {
    
     private final Connection cnx = Database.getInstance().getCon();
    public void ADD(Reclamation_Category category){
        try{
            PreparedStatement ps = cnx.prepareStatement("INSERT INTO RECLAMATION_CATEGORY(ID,NAME,DESCRIPTION) values (?,?,?)");
            category.setId(UUID.randomUUID().toString());
            ps.setString(1,category.getId());
            ps.setString(2, category.getName());
            ps.setString(3, category.getDescription());
            ps.executeUpdate();
        }catch (Exception ignored){
                System.out.println(ignored.getMessage());
        }
    }
    public HashMap<Integer,Reclamation_Category> READALL(){
        try{
            Statement st = cnx.createStatement();
            ResultSet rs = st.executeQuery("SELECT * FROM RECLAMATION_CATEGORY WHERE 1");
            HashMap<Integer, Reclamation_Category> categories = new HashMap<>();
            int i = 0;
            while(rs.next()){
                categories.put(++i,new Reclamation_Category(rs.getString(1),rs.getString(2),rs.getString(3)));
            }
            return categories;
        }catch (Exception ignored){
            return null;
        }
    }
    public Reclamation_Category READONE(Reclamation_Category category){
        try{
            PreparedStatement ps = cnx.prepareStatement("SELECT * FROM RECLAMATION_CATEGORY WHERE ID = ?");
            ps.setString(1,category.getId());
            ResultSet rs = ps.executeQuery();
            if(rs.next()){
                return new Reclamation_Category(rs.getString(1),rs.getString(2),rs.getString(3));
            }
            return null;
        }catch (Exception ignored){
            return null;
        }
    }
    public void DELETE(Reclamation_Category category){
        try{
            PreparedStatement ps = cnx.prepareStatement("DELETE FROM RECLAMATION_CATEGORY WHERE ID = ?");
            ps.setString(1, category.getId());
            ps.executeUpdate();
        }catch (Exception ignored){

        }
    }
    public void UPDATE(Reclamation_Category category){
        try{
            PreparedStatement ps = cnx.prepareStatement("UPDATE RECLAMATION_CATEGORY SET NAME = ? , DESCRIPTION = ? where id = ?");
            ps.setString(1,category.getName());
            ps.setString(2, category.getDescription());
            ps.setString(3, category.getId());
            ps.executeUpdate();
        }catch (Exception ignored){

        }
    }

}




