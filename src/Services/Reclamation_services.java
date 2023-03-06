/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Services;

import Entity.Reclamation;
import Entity.Reclamation_Category;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Timestamp;
import java.util.HashMap;
import java.util.UUID;
import util.DataSource;

/**
 *
 * @author fairouzkhayat
 */
public class Reclamation_services {
    private final Connection cnx = DataSource.getInstance().getCnx();
    public void ADD(Reclamation reclamation){
        try{
            PreparedStatement ps = cnx.prepareStatement("INSERT INTO `fancytrade`.`reclamation` (`reclamation_Date`,`reclamation_category_id`,`reclamation_type`,`description`) VALUES (?,?,?,?)");
            ps.setString(1,reclamation.getReclamation_type());
            ps.setString(2,reclamation.getReclamation_Date());
            ps.setString(3,reclamation.getReclamation_category_id());
            ps.setString(4,reclamation.getDescription());

        }catch (Exception ignored){
            System.out.print(ignored.getMessage());
        }
    }
    public void DELETE(Reclamation reclamation){
        try{
            PreparedStatement ps = cnx.prepareStatement("DELETE FROM RECLAMATION WHERE ID = ?");
            ps.setInt(1,reclamation.getId());
            ps.executeUpdate();
        }catch (Exception ignored){

        }
    }
    public HashMap<Integer,Reclamation> READALL(Reclamation_Category category){
        try{
            PreparedStatement ps = cnx.prepareStatement("SELECT * FROM RECLAMATION WHERE reclamation_category_id = ?");
            ResultSet rs = ps.executeQuery();
            HashMap<Integer,Reclamation> reclamations = new HashMap<>();
            int i = 0;
            while(rs.next()){
                //reclamations.put(++i,new Reclamation(rs.getString(1),rs.getString(2),rs.getString(3),rs.getString(4),rs.getString(5),rs.getString(6),rs.getInt(7),rs.getTimestamp(8),rs.getTimestamp(9)));
            }
            return  reclamations;
        }catch (Exception ignored){
            return null;
        }
    }
    public void UPDATE(Reclamation reclamation){
        try{
            PreparedStatement ps = cnx.prepareStatement("UPDATE RECLAMATION SET reclamation_category_id = ?,user_id = ?, reclamated_type = ? , reclamated_id = ? , description = ?, status = ? where id= ? ");
            ps.setString(1,reclamation.getReclamation_category_id());
            ps.setString(2,reclamation.getUser_id());
            ps.setString(3,reclamation.getReclamation_type());
            ps.setString(5,reclamation.getDescription());
            ps.setInt(7,reclamation.getId());
        }catch (Exception ignored){

        }
    }
}

    


    

