/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package crud_app.utils;

import java.sql.Connection;
import java.sql.DriverManager;

/**
 *
 * @author user
 */
public class database {
    public static Connection connect(){
        try{
            Connection connect = DriverManager.getConnection("jdbc:mysql://localhost:3306/fancytrade", "root","");
            return connect;
        }
        catch(Exception e)
        {
            e.printStackTrace();
            return null;
        }
    }
    
}
