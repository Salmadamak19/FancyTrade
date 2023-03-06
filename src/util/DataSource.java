/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package util;

import java.sql.Connection;
import java.sql.DriverManager;

/**
 *
 * @author fairouzkhayat
 */
public class DataSource {    
    
private Connection cnx;
    private DataSource(){
        try {
            String USERNAME = "root";
            String db_name = "fancytrade";
            String url = "jdbc:mysql://localhost:3306/fancytrade";
            String MY_PASS = "root";
            cnx = DriverManager.getConnection(url, USERNAME, MY_PASS);
         System.out.println("JDBC CONNECTED TO ");
        }catch (Exception ex ) {
          
         System.out.println(ex.getMessage());
        }
    }
    public static DataSource getInstance() {
        return new DataSource();
    }

    public Connection getCnx() {
        return cnx;
    }
   
    
}


    

