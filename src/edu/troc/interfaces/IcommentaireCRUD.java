/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package edu.troc.interfaces;

import edu.troc.model.commentaire;
import java.util.List;

public interface IcommentaireCRUD {
    


    public void ajoutercommentaire(commentaire c);
   
    

    public void modifiercommentaire(commentaire c);

   
    public void supprimercommentaire(int id);

    public List<commentaire> affichercommentaire();
    


}