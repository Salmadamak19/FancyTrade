/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package main;

import Entity.Reclamation;
import Entity.Reclamation_Category;
import Services.Reclamation_category_services;
import Services.Reclamation_services;
import util.DataSource;

/**
 *
 * @author fairouzkhayat
 */
public class Main {
    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
                 DataSource db=DataSource.getInstance();

        //System.out.print("ho");
//        Reclamation_Category cat = new  Reclamation_Category("333aca3d-7392-4d27-8e3a-fabc43c93a42","desc","dkghdkf");
//        new Reclamation_category_services().add(cat);
//                Reclamation_services c = new Reclamation_services();
//                c.ADD(rec);

Reclamation cat = new  Reclamation("desc","dkghdkf","sdsd","sdsd");
Reclamation_services ss= new Reclamation_services();
ss.ADD(cat);
                
}
    
}
