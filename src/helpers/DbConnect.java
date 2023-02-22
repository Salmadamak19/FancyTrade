/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package helpers;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


/**
 *
 * @author Andrew
 */
public class DbConnect {
    final String url="jdbc:mysql://localhost/fancytrade";
    final String user="root";
    final String pwd="";
    Connection con;
    
    //creer un 
    public static DbConnect db;
    
  
   //rendre le constructeur prive
    private DbConnect() {
        
        try {
            System.out.println("Connexion en cours");
            con= (Connection) DriverManager.getConnection(url, user, pwd);
            System.out.println("Connexion etablie");
        } catch (SQLException ex) {
            System.out.println("Probleme de connexion : "+ex.getMessage());
            
        }
    }
    
    //une methode static
    public static DbConnect getInstance(){
        if(db==null)
            db=new DbConnect();
        return db;
        
    }

    public Connection getCon() {
        return con;
    }
    
    
    
    
    
            
    
}
