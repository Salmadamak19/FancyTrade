/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package troc;


import edu.troc.model.poste;

import edu.troc.services.posteCRUD;
import java.sql.Date;
import java.sql.SQLException;


/**
 *
 * @author khmir
 */
public class troc {

    /**
     * @param args the command line arguments
     * @throws java.sql.SQLException
     */
    public static void main(String[] args) throws SQLException {
       
        poste p1 = new poste(String.valueOf("2023-1-10"),"aaaa","rades","xd","aaaa",12,"dedede");

    
        posteCRUD pos = new posteCRUD();
     pos.ajouterposte(p1);
       System.out.print(pos.afficherposte());
       // pos.supprimerposte(3);
       //  poste mod = new poste(4,Date.valueOf("2023-1-10"),"bbbbbbbbbb","rades","xd","aaaa",12,"dedede");
      //   pos.modifierposte(mod);

      
    }

}
